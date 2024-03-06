let debounceTimer;

function debounceSearch(route) {
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(function () {
        searchPost(route);
    }, 500);
}

function searchPost(route) {
    // console.log(route);
    var searchQuery = document.getElementById("search-input").value;

    console.log(searchQuery, route);

    $.ajax({
        url: `${route}`,
        method: "GET",
        data: { query: searchQuery },
        dataType: "json",
        success: function (response) {
            console.log("Search results:", response.data);

            var resultsContainer = document.getElementById("search-list");

            var list = response.data.map((element) => {
                return `<div class="search-item-container ">
                        <div class="sc-image-wrapper ">
                            <img src={{ asset('/') }} />
                        </div>
                        <div class="sc-title-wrapper ">
                            <p>This is sample title</p>
                        </div>
                        </div>`;
            });
            console.log(list);
            console.log(resultsContainer);
            resultsContainer.innerHTML(list);
            // var searchList = document.getElementById("search-list");
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function displayData() {}
