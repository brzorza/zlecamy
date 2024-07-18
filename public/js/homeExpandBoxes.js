function toggleContent(id) {
    const contents = document.querySelectorAll(".catrgory-box-content");
    const wrappers = document.querySelectorAll(".expand-home-wrap");

    contents.forEach((content) => {
        if (content.id !== `content-${id}`) {
            content.classList.remove("show");
        } else {
            content.classList.add("show");
        }
    });

    wrappers.forEach((wrapper) => {
        if (wrapper.id !== `wrapper-${id}`) {
            wrapper.classList.add("border-primary");
            wrapper.classList.remove("border-secondary");
        } else {
            wrapper.classList.add("border-secondary");
            wrapper.classList.remove("border-primary");
        }
    });
}
