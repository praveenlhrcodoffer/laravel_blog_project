var searchInput = document.getElementById("search-input");
var resultsContainer = document.getElementById("search-list");
let searchData = [];
let searchQuery = "";

// ------------––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
function searchPost(route, searchQuery) {
    $.ajax({
        url: route,
        method: "GET",
        data: { query: searchQuery },
        dataType: "json",
        success: function (response) {
            searchData = response.data;
            // console.log(searchQuery, searchData);

            resultsContainer.style.height =
                searchData && searchData.length > 0 && searchQuery.length > 0
                    ? "300px"
                    : "0px";

            var list = searchData
                .map((item) => {
                    return `<div class="search-item-container">
                                <div class="sc-image-wrapper">
                                    <a href="/posts/${item.id}">
                                        <img src="storage/${item.image_url}" alt="${item.title}" />
                                    </a>
                                    </div>
                                <div class="sc-title-wrapper">
                                    <p>${item.title}</p>
                                    <span>• ${item.author}</span>
                                </div>
                            </div>`;
                })
                .join("");

            resultsContainer.innerHTML = list;
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}
// ------------––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
let debounceTimer;

function debounceSearch(route, searchQuery) {
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(function () {
        // console.log(route, searchQuery);
        searchPost(route, searchQuery);
    }, 500);
}

// ------------––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

searchInput.addEventListener("input", () => {
    route = searchInput.getAttribute("data-route");

    searchQuery = searchInput.value;

    debounceSearch(route, searchQuery);

    if (searchQuery.length >= 1) {
    } else if (searchQuery.length <= 0) {
        clearSearch();
    }
});

// ------------––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
function clearSearch() {
    searchData = [];
    resultsContainer.innerHTML = "";
    resultsContainer.style.height = "0px";
}
