document.addEventListener("DOMContentLoaded", function() {
  if (document.getElementsByClassName("post-content").length > 0) {
    const postContents = document.querySelectorAll(".post-content");
    postContents.forEach((postContent) => {
      // Create summary in blog post
      const titles = postContent.querySelectorAll("h2");
      const summaryDOM = postContent.querySelector(".summary");

      titles.forEach((title, index) => {
        const id = `title-${index}`;
        title.id = id;
        const curatedTitle = document.createElement("a");
        curatedTitle.href = `#${id}`;
        curatedTitle.innerHTML = `${index} - ${title.innerHTML}`;

        summaryDOM.append(curatedTitle);
      });
    });
  }
});
