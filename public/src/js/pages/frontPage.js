document.addEventListener("DOMContentLoaded", function() {
    const categoryButtons = document.querySelectorAll("#category-filters button");
    const searchInput = document.getElementById("search__input");
    const posts = document.querySelectorAll("#posts .posts__column");

    /*  Filter function
        The data category of the buttons is validated against the data category of the posts. 
    */
    categoryButtons.forEach(button => {
        button.addEventListener("click", function() {
            const category = this.getAttribute("data-category");
            posts.forEach(post => {
                const postCategory = post.getAttribute("data-category");
                if (category === "all" || postCategory === category) {
                    post.style.visibility = "visible";
                    post.style.position = "relative";
                } else {
                    post.style.visibility = "hidden";
                    post.style.position = "absolute";
                }
            });
        });
    });

    // Search function
    searchInput.addEventListener("input", function() {
        // input value
        const searchText = this.value.toLowerCase();

        posts.forEach(post => {
            // post title
            const postTitle = post.querySelector(".card__title").innerText.toLowerCase();
            // It is validated if the entered word is included in the post title variable
            if (postTitle.includes(searchText)) {
                post.style.visibility = "visible";
                post.style.position = "relative";
            } else {
                post.style.visibility = "hidden";
                post.style.position = "absolute";
            }
        });
    });
});