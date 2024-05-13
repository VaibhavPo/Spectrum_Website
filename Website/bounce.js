// JavaScript code to add bounce animation to icons on scroll
document.addEventListener("DOMContentLoaded", function () {
  const icons = document.querySelectorAll(".fa-bounce");

  // Function to check if an element is in the viewport
  function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  // Function to add bounce animation to icons when they are in the viewport
  function handleScroll() {
    icons.forEach((icon) => {
      if (isInViewport(icon)) {
        icon.classList.add("bounce");
      } else {
        icon.classList.remove("bounce");
      }
    });
  }

  // Add a scroll event listener to check when icons are in the viewport
  window.addEventListener("scroll", handleScroll);
  
  // Initial check for icons on page load
  handleScroll();
});
