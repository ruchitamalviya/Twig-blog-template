const body = document.body;
const headerSection = document.getElementsByClassName('header_section')[0]
const scrollUp = "scroll-up";
const scrollDown = "scroll-down";
const stickyHeader = "stikey-header";
let lastScroll = 0;

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;
  if (currentScroll <= 0) {
    body.classList.remove(scrollUp);
    body.classList.remove(stickyHeader);
    return;
  }

  if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
    body.classList.add(stickyHeader);
    body.classList.remove(scrollUp);
    body.classList.add(scrollDown); 
  }else if ( currentScroll < lastScroll && body.classList.contains(scrollDown)) {
    // up
    headerSection.style.top = null;
    body.classList.remove(scrollDown);
    body.classList.add(scrollUp);
    body.classList.add(stickyHeader);
  } else if (currentScroll > 500 && body.classList.contains(scrollDown)) {
    body.classList.remove(stickyHeader);
  } else if(currentScroll < 500 && body.classList.contains(scrollDown))  {
    headerSection.style.top = Math.floor((500 - currentScroll)/6) + "px";
  }
  lastScroll = currentScroll;
});
