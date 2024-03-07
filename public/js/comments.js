let inputField = document.getElementById("comment-input");
let commentsList = document.getElementById("comments-list");

function addPost(post_id, user, route) {
    let { fullname, id } = (user = JSON.parse(user));

    post_id = JSON.parse(post_id);

    let formData = new FormData(document.getElementById("comment-form"));
    let inputField = document.getElementById("comment-input");

    formData.append("user_id", id);
    formData.append("post_id", post_id);
    formData.append("username", fullname);

    // for (let [key, value] of formData.entries()) {
    //     console.log(key, value);
    // }

    $.ajax({
        url: route,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "JSON",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (response) {
            console.log(response);
            let commentItem = `  <div class="comment-item-div">
            <p id="commented-author-text">${inputField.value}</p>
            <p id="commented-text-text"> - ${fullname}</p>
        </div>`;

            console.log(commentsList);
            console.log(commentItem);

            let tempElement = document.createElement("div");
            tempElement.innerHTML = commentItem;

            commentsList.appendChild(tempElement);
        },
        error: function (error) {
            console.log(error);
        },
    });
}
