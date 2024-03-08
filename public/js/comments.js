let inputField = document.getElementById("comment-input");
let commentsList = document.getElementById("comments-list");
// ----------------------------------------------------------------------------------------------------------

function addPost(post_id, user, addRoute, deleteRoute, editRoute) {
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
        url: addRoute,
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
            let commentItem = `
            <div class="comment-item-container" id="comment-item-${response.comment_id}" style="width:70%; min-width:70%">
                <div class="comment-text-input-cell">
                    <p id="commented-text-text-${response.comment_id}">${inputField.value}</p>
                    <input class="comment-edit-input" id="comment-edit-input-${response.comment_id}" />
                </div>
                <div class="username-curd-btn-cell">
                    <p id="commented-author-text"> - You</p>
                    <div class="edit-delete-btn-container" id="edit-delete-btn-container-${response.comment_id}">
                        <button type="button" onclick="toggleCommentEditForm(${response.comment_id})" id="comment-edit-btn" class="crud-btn">
                            <p>EDIT</p>
                        </button>
                        <button type="button" onclick="confirmDeleteComment('${deleteRoute}', '${id}', '${response.comment_id}')" id="comment-del-btn" class="crud-btn">
                            <p>DELETE</p>
                        </button>
                    </div>
                    <div class="save-cancel-btn-container" id="save-cancel-btn-container-${response.comment_id}" style="display: none;">
                        <button type="button" onclick="cancelEditComment(${response.comment_id})" id="comment-edit-btn" class="crud-btn">
                            <p>CANCEL</p>
                        </button>
                        <button type="button" onclick="confirmSave('${editRoute}', '${id}', '${response.comment_id}')" id="comment-del-btn" class="crud-btn">
                            <p>SAVE</p>
                        </button>
                    </div>
                </div>
            </div>
        `;

            let tempElement = document.createElement("div");
            tempElement.innerHTML = commentItem;
            tempElement.style.width = commentsList.clientWidth + "px";

            console.log(commentsList.clientWidth);
            console.log(tempElement.clientWidth);

            commentsList.appendChild(tempElement);
            // console.log(commentsList.scrollHeight);
            commentsList.scrollTop = commentsList.scrollHeight;
        },
        error: function (error) {
            console.log(error);
        },
    });
}
// ----------------------------------------------------------------------------------------------------------

function deleteComment(route, user_id, comment_id) {
    // console.log("deleting", user_id, comment_id);
    // console.log("route->", route);

    // console.log("_token", $("input[name=_token]").val());
    // console.log("_token", $('meta[name="csrf-token"]').attr("content"));

    const csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;

    // console.log(csrfToken);

    // console.log(csrfToken);
    $.ajax({
        url: route,
        type: "delete",
        data: {
            user_id: user_id,
            comment_id: comment_id,
        },
        dataType: "JSON",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },

        success: function (response) {
            console.log(response.comment_id);
            $("#comment-item-" + response.comment_id).remove();
        },
        error: function (error) {
            console.log(error);
        },
    });
}
// ----------------------------------------------------------------------------------------------------------

function confirmDeleteComment(user_id, comment_id, route) {
    if (confirm("Are you sure you want to delete this comment ?")) {
        deleteComment(user_id, comment_id, route);
    }
}

// ----------------------------------------------------------------------------------------------------------
function toggleCommentEditForm(comment_id, inputValue) {
    let itemP = document.getElementById(
        "commented-text-text-" + `${comment_id}`
    );
    let itemInput = document.getElementById(
        "comment-edit-input-" + `${comment_id}`
    );
    let editDelContainer = document.getElementById(
        "edit-delete-btn-container-" + `${comment_id}`
    );
    let saveCanContainer = document.getElementById(
        "save-cancel-btn-container-" + `${comment_id}`
    );
    // console.log(itemP);
    // console.log(itemInput);
    // console.log(editDelContainer);
    // console.log(saveCanContainer);

    itemP.style.display = "none";
    editDelContainer.style.display = "none";

    itemInput.style.display = "flex";
    saveCanContainer.style.display = "flex";

    itemInput.value = itemP.innerText;

    document.getElementById("");
}
// ----------------------------------------------------------------------------------------------------------

function cancelEditComment(comment_id) {
    console.log(comment_id);

    let itemP = document.getElementById(
        "commented-text-text-" + `${comment_id}`
    );
    let itemInput = document.getElementById(
        "comment-edit-input-" + `${comment_id}`
    );
    let editDelContainer = document.getElementById(
        "edit-delete-btn-container-" + `${comment_id}`
    );
    let saveCanContainer = document.getElementById(
        "save-cancel-btn-container-" + `${comment_id}`
    );

    // console.log(itemP);
    // console.log(itemInput);
    // console.log(editDelContainer);
    // console.log(saveCanContainer);

    itemP.style.display = "flex";
    editDelContainer.style.display = "flex";

    itemInput.style.display = "none";
    saveCanContainer.style.display = "none";
}
// ----------------------------------------------------------------------------------------------------------

function confirmSave(editRoute, user_id, comment_id) {
    console.log("saving...", editRoute, user_id, comment_id);

    let itemInput = document.getElementById(
        "comment-edit-input-" + `${comment_id}`
    );
    let itemP = document.getElementById(
        "commented-text-text-" + `${comment_id}`
    );

    const csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;

    $.ajax({
        url: editRoute,
        type: "PUT",
        data: {
            user_id: user_id,
            comment_id: comment_id,
            update_comment: itemInput.value,
        },
        dataType: "JSON",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },

        success: function (response) {
            console.log(response.data);
            itemP.innerText = response.data.comment;
            cancelEditComment(response.data.id);

            // $("#comment-item-" + response.comment_id).remove();
        },
        error: function (error) {
            console.log(error);
        },
    });
}
