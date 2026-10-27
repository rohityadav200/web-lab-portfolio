
$(document).ready(function () {
    "use strict";

    // -----------------------------
    // Configuration
    // -----------------------------
    const API_URL = "https://openlibrary.org/search.json";
    const PAGE_SIZE = 20;
    const STORAGE_KEY = "bookExplorerFavourites";

    let currentQuery = "";
    let currentPage = 1;
    let totalResults = 0;
    let allBooks = [];
    let isLoading = false;
    let lastFocusedElement = null;

    // -----------------------------
    // Load favourites safely
    // -----------------------------
    function loadFavourites() {
        try {
            const saved = localStorage.getItem(STORAGE_KEY);
            const parsed = saved ? JSON.parse(saved) : {};

            return parsed && typeof parsed === "object" && !Array.isArray(parsed)
                ? parsed
                : {};
        } catch (error) {
            console.warn("Could not load saved favourites:", error);
            return {};
        }
    }

    let favourites = loadFavourites();

    function saveFavourites() {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(favourites));
            return true;
        } catch (error) {
            console.warn("Could not save favourites:", error);
            showStatus("Your browser could not save favourites. Check storage settings.", "error");
            return false;
        }
    }

    function getFavouriteCount() {
        return Object.keys(favourites).length;
    }

    // -----------------------------
    // Helpers
    // -----------------------------
    function getBookKey(book) {
        if (book && book.key) {
            return book.key;
        }

        const title = book && book.title ? book.title : "untitled";
        const author = book && book.author_name
            ? book.author_name.join(", ")
            : "unknown";

        return (title + "-" + author)
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, "-");
    }

    function getAuthors(book) {
        if (Array.isArray(book.author_name) && book.author_name.length) {
            return book.author_name.join(", ");
        }

        return "Author information unavailable";
    }

    function getCoverUrl(book, size = "M") {
        if (!book.cover_i) {
            return "";
        }

        return "https://covers.openlibrary.org/b/id/" +
            encodeURIComponent(book.cover_i) + "-" + size + ".jpg";
    }

    function showStatus(message, type = "") {
        const $status = $("#statusMessage");

        $status
            .removeClass("error success")
            .text(message);

        if (type) {
            $status.addClass(type);
        }
    }

    function updateFavouriteCount() {
        $("#favouriteCount").text(getFavouriteCount());
    }

    function escapeExternalUrl(key) {
        if (typeof key !== "string" || !/^\/works\/OL[0-9]+W$/.test(key)) {
            return "https://openlibrary.org";
        }

        return "https://openlibrary.org" + key;
    }

    // -----------------------------
    // API search
    // -----------------------------
    function searchBooks(query, page = 1) {
        if (isLoading) {
            return;
        }

        if (!query.trim()) {
            showStatus("Please enter a book title or author name.", "error");
            return;
        }

        currentQuery = query.trim();
        currentPage = page;
        isLoading = true;

        $("#searchBtn").prop("disabled", true).text("Searching...");
        $("#loadMoreBtn").prop("disabled", true);

        if (page === 1) {
            allBooks = [];
            totalResults = 0;

            $("#resultsHeading").text("Search Results");
            $("#resultsSubtitle").text('Results for "' + currentQuery + '"');
            $("#booksContainer").empty();
            $("#paginationMessage").text("");
            $("#loadMoreBtn").prop("hidden", true);
            $("#resultCount").text("0");

            showStatus("Searching Open Library...", "");
            $("#booksContainer").html(
                '<div class="empty-state">' +
                    '<div class="loading-spinner"></div>' +
                    '<h3>Finding your next read...</h3>' +
                    '<p>Please wait while we search the library.</p>' +
                '</div>'
            );
        } else {
            showStatus("Loading more books...", "");
        }

        $.ajax({
            url: API_URL,
            method: "GET",
            dataType: "json",
            timeout: 20000,
            data: {
                q: currentQuery,
                fields: [
                    "key",
                    "title",
                    "author_name",
                    "first_publish_year",
                    "cover_i",
                    "edition_count",
                    "subject",
                    "publisher",
                    "isbn"
                ].join(","),
                limit: PAGE_SIZE,
                page: page
            }
        })
        .done(function (response) {
            const docs = Array.isArray(response.docs) ? response.docs : [];

            totalResults = Number(
                response.numFound ?? response.num_found ?? docs.length
            );

            if (page === 1) {
                allBooks = [];
            }

            // Prevent duplicate records when adding another page.
            const existingKeys = new Set(allBooks.map(getBookKey));

            docs.forEach(function (book) {
                if (!book || !book.title) {
                    return;
                }

                const key = getBookKey(book);

                if (!existingKeys.has(key)) {
                    book._bookKey = key;
                    allBooks.push(book);
                    existingKeys.add(key);
                }
            });

            // Refresh saved favourite information with any new API data.
            allBooks.forEach(function (book) {
                const key = getBookKey(book);

                if (favourites[key]) {
                    favourites[key] = {
                        ...favourites[key],
                        ...book,
                        _bookKey: key
                    };
                }
            });

            saveFavourites();
            updateFavouriteCount();

            $("#resultsHeading").text("Search Results");
            $("#resultsSubtitle").text(
                'Books matching "' + currentQuery + '"'
            );

            renderBooks();

            if (docs.length === 0 && page === 1) {
                showStatus("No books found. Try another title or author.", "error");
            } else {
                showStatus(
                    "Search complete. Explore the results and save your favourites.",
                    "success"
                );
            }
        })
        .fail(function (xhr, status) {
            let message = "Unable to load books. Please try again.";

            if (status === "timeout") {
                message = "The request took too long. Please check your internet connection.";
            } else if (xhr.status === 429) {
                message = "Too many requests. Wait a moment and try again.";
            } else if (xhr.status === 0) {
                message = "Could not connect. Check your internet connection and try again.";
            }

            showStatus(message, "error");

            if (page === 1) {
                $("#booksContainer").html(
                    '<div class="empty-state error-state">' +
                        '<div class="empty-icon">⚠️</div>' +
                        '<h3>Something went wrong</h3>' +
                        '<p></p>' +
                        '<button type="button" id="retryBtn" class="secondary-btn">Try Again</button>' +
                    '</div>'
                );

                $("#booksContainer .empty-state p").text(message);
            } else {
                $("#paginationMessage").text(message);
            }
        })
        .always(function () {
            isLoading = false;

            $("#searchBtn").prop("disabled", false).text("Search Books");
            $("#loadMoreBtn").prop("disabled", false);
        });
    }

    // -----------------------------
    // Render book cards
    // -----------------------------
    function createBookCard(book, index) {
        const key = getBookKey(book);
        const isFavourite = Boolean(favourites[key]);
        const title = book.title || "Untitled";
        const author = getAuthors(book);
        const year = book.first_publish_year || "Year unavailable";
        const coverUrl = getCoverUrl(book);

        const $card = $("<article>").addClass("book-card");

        const $coverWrapper = $("<div>").addClass("book-cover");

        if (coverUrl) {
            const $image = $("<img>")
                .attr({
                    src: coverUrl,
                    alt: "Cover of " + title,
                    loading: "lazy"
                });

            $image.on("error", function () {
                $(this).remove();

                if (!$coverWrapper.find(".cover-placeholder").length) {
                    $("<div>")
                        .addClass("cover-placeholder")
                        .text("📚")
                        .appendTo($coverWrapper);
                }
            });

            $coverWrapper.append($image);
        } else {
            $("<div>")
                .addClass("cover-placeholder")
                .text("📚")
                .appendTo($coverWrapper);
        }

        $("<span>")
            .addClass("book-number")
            .text("#" + (index + 1))
            .appendTo($coverWrapper);

        const $favouriteButton = $("<button>")
            .attr({
                type: "button",
                "aria-label": isFavourite
                    ? "Remove " + title + " from favourites"
                    : "Add " + title + " to favourites",
                "aria-pressed": String(isFavourite),
                title: isFavourite ? "Remove from favourites" : "Add to favourites"
            })
            .addClass("favourite-btn")
            .toggleClass("is-favourite", isFavourite)
            .text(isFavourite ? "♥" : "♡")
            .on("click", function () {
                toggleFavourite(book);
            });

        $coverWrapper.append($favouriteButton);

        const $info = $("<div>").addClass("book-info");

        $("<h3>")
            .text(title)
            .appendTo($info);

        $("<p>")
            .addClass("book-author")
            .text(author)
            .appendTo($info);

        $("<p>")
            .addClass("book-year")
            .text("First published: " + year)
            .appendTo($info);

        const $actions = $("<div>").addClass("book-actions");

        $("<button>")
            .attr("type", "button")
            .addClass("details-btn")
            .text("View Details")
            .on("click", function () {
                openBookDetails(key);
            })
            .appendTo($actions);

        $info.append($actions);
        $card.append($coverWrapper, $info);

        return $card;
    }

    // -----------------------------
    // Sorting and filtering
    // -----------------------------
    function getVisibleBooks() {
        let books;

        if ($("#viewFilter").val() === "favourites") {
            books = Object.values(favourites);
        } else {
            books = allBooks.slice();
        }

        const sortBy = $("#sortBy").val();

        if (sortBy === "title-asc") {
            books.sort((a, b) =>
                (a.title || "").localeCompare(b.title || "")
            );
        } else if (sortBy === "title-desc") {
            books.sort((a, b) =>
                (b.title || "").localeCompare(a.title || "")
            );
        } else if (sortBy === "year-desc") {
            books.sort((a, b) =>
                (Number(b.first_publish_year) || 0) -
                (Number(a.first_publish_year) || 0)
            );
        } else if (sortBy === "year-asc") {
            books.sort((a, b) => {
                const yearA = Number(a.first_publish_year) || Infinity;
                const yearB = Number(b.first_publish_year) || Infinity;
                return yearA - yearB;
            });
        }

        return books;
    }

    function renderBooks() {
        const $container = $("#booksContainer");
        const books = getVisibleBooks();
        const showingFavourites = $("#viewFilter").val() === "favourites";

        $container.empty();

        $("#resultCount").text(books.length);
        updateFavouriteCount();

        if (books.length === 0) {
            const $empty = $("<div>").addClass("empty-state");

            $("<div>").addClass("empty-icon").text("📚").appendTo($empty);

            $("<h3>")
                .text(showingFavourites ? "No favourites yet" : "No books to display")
                .appendTo($empty);

            $("<p>")
                .text(
                    showingFavourites
                        ? "Tap the heart on a book to save it to your library."
                        : "Search for a book title or author to get started."
                )
                .appendTo($empty);

            $container.append($empty);
        } else {
            books.forEach(function (book, index) {
                $container.append(createBookCard(book, index));
            });
        }

        if (showingFavourites) {
            $("#paginationMessage").text(
                books.length + " saved favourite" + (books.length === 1 ? "" : "s")
            );

            $("#loadMoreBtn").prop("hidden", true);
            return;
        }

        const loaded = allBooks.length;
        const total = Math.max(totalResults, loaded);

        $("#paginationMessage").text(
            loaded > 0 ? "Showing " + loaded + " of " + total + " results" : ""
        );

        const hasMore = loaded < totalResults &&
            allBooks.length > 0;

        $("#loadMoreBtn").prop("hidden", !hasMore);
    }

    // -----------------------------
    // Favourites / wishlist
    // -----------------------------
    function toggleFavourite(book) {
        const key = getBookKey(book);

        if (favourites[key]) {
            delete favourites[key];
            showStatus('Removed "' + (book.title || "Book") + '" from favourites.', "success");
        } else {
            favourites[key] = {
                ...book,
                _bookKey: key
            };

            showStatus('Saved "' + (book.title || "Book") + '" to favourites.', "success");
        }

        saveFavourites();
        updateFavouriteCount();
        renderBooks();
    }

    // -----------------------------
    // Book details modal
    // -----------------------------
    function openBookDetails(key) {
        const book =
            allBooks.find(item => getBookKey(item) === key) ||
            favourites[key];

        if (!book) {
            showStatus("Book details are not available. Please search again.", "error");
            return;
        }

        lastFocusedElement = document.activeElement;

        const $body = $("#modalBody");
        $body.empty();

        const $details = $("<div>").addClass("modal-book");
        const coverUrl = getCoverUrl(book, "L");

        if (coverUrl) {
            const $cover = $("<img>")
                .addClass("modal-book-cover")
                .attr({
                    src: coverUrl,
                    alt: "Cover of " + (book.title || "book")
                });

            $cover.on("error", function () {
                $(this).replaceWith(
                    $("<div>").addClass("cover-placeholder").text("📚")
                );
            });

            $details.append($cover);
        } else {
            $details.append(
                $("<div>").addClass("cover-placeholder modal-book-cover").text("📚")
            );
        }

        const $information = $("<div>").addClass("modal-book-info");

        $("<span>")
            .addClass("eyebrow")
            .text("BOOK DETAILS")
            .appendTo($information);

        $("<h2>")
            .attr("id", "modalTitle")
            .text(book.title || "Untitled")
            .appendTo($information);

        $("<p>")
            .addClass("modal-author")
            .text("By " + getAuthors(book))
            .appendTo($information);

        $("<p>")
            .text("First published: " + (book.first_publish_year || "Unknown"))
            .appendTo($information);

        $("<p>")
            .text("Editions: " + (book.edition_count || "Unknown"))
            .appendTo($information);

        if (Array.isArray(book.publisher) && book.publisher.length) {
            $("<p>")
                .text("Publisher: " + book.publisher.slice(0, 3).join(", "))
                .appendTo($information);
        }

        if (Array.isArray(book.subject) && book.subject.length) {
            $("<p>")
                .text("Subjects: " + book.subject.slice(0, 5).join(", "))
                .appendTo($information);
        }

        $("<a>")
            .attr({
                href: escapeExternalUrl(book.key),
                target: "_blank",
                rel: "noopener noreferrer"
            })
            .addClass("details-btn")
            .text("Open on Open Library ↗")
            .appendTo($information);

        const $favouriteButton = $("<button>")
            .attr("type", "button")
            .addClass("secondary-btn")
            .text(favourites[key] ? "♥ Remove Favourite" : "♡ Add to Favourites")
            .on("click", function () {
                toggleFavourite(book);

                $(this).text(
                    favourites[key] ? "♥ Remove Favourite" : "♡ Add to Favourites"
                );
            });

        $information.append($favouriteButton);
        $details.append($information);
        $body.append($details);

        $("#bookModal").prop("hidden", false).addClass("is-open");
        $("body").addClass("modal-open");
        $("#closeModalBtn").trigger("focus");
    }

    function closeBookDetails() {
        $("#bookModal").prop("hidden", true).removeClass("is-open");
        $("body").removeClass("modal-open");

        if (lastFocusedElement && typeof lastFocusedElement.focus === "function") {
            lastFocusedElement.focus();
        }
    }

    // -----------------------------
    // Event handlers
    // -----------------------------
    $("#searchForm").on("submit", function (event) {
        event.preventDefault();

        const query = $("#searchInput").val().trim();

        if (query) {
            $("#viewFilter").val("all");
            searchBooks(query, 1);
        } else {
            showStatus("Enter a title or author to search.", "error");
        }
    });

    $(".quick-search").on("click", function () {
        const query = $(this).data("query");

        $("#searchInput").val(query);
        $("#viewFilter").val("all");
        searchBooks(query, 1);
    });

    $("#loadMoreBtn").on("click", function () {
        if (!isLoading && currentQuery) {
            searchBooks(currentQuery, currentPage + 1);
        }
    });

    $("#refreshBtn").on("click", function () {
        if (currentQuery) {
            searchBooks(currentQuery, 1);
        } else {
            $("#searchInput").trigger("focus");
            showStatus("Enter a title or author before reloading results.", "error");
        }
    });

    $("#retryBtn").on("click", function () {
        if (currentQuery) {
            searchBooks(currentQuery, 1);
        }
    });

    $("#viewFilter, #sortBy").on("change", function () {
        renderBooks();

        if ($("#viewFilter").val() === "favourites") {
            $("#resultsHeading").text("My Library");
            $("#resultsSubtitle").text("Your saved favourite books.");
        } else if (currentQuery) {
            $("#resultsHeading").text("Search Results");
            $("#resultsSubtitle").text('Books matching "' + currentQuery + '"');
        } else {
            $("#resultsHeading").text("Discover Books");
            $("#resultsSubtitle").text("Your next favourite book might be here.");
        }
    });

    $("#closeModalBtn").on("click", closeBookDetails);

    $("[data-close-modal]").on("click", closeBookDetails);

    $(document).on("keydown", function (event) {
        if (event.key === "Escape" && !$("#bookModal").prop("hidden")) {
            closeBookDetails();
        }
    });

    // -----------------------------
    // Initial state
    // -----------------------------
    updateFavouriteCount();
    $("#resultCount").text("0");
});
