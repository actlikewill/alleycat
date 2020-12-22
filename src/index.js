import 'code-prettify';

window.addEventListener( "load",  () => {  
    PR.prettyPrint();
    const tabs = document.querySelectorAll("ul.nav-tabs > li");
    const setListener = (tab) => {tab.addEventListener("click", switchTab)};
    const switchTab = (event) => {
            event.preventDefault();
            document.querySelector("ul.nav-tabs li.active").classList.remove("active");   
            document.querySelector(".tab-pane.active").classList.remove("active");       
            const clickedTab = event.currentTarget;
            const anchor = event.target;
            const activePaneID = anchor.getAttribute("href");
            clickedTab.classList.add("active");
            document.querySelector(activePaneID).classList.add("active");
            };
    tabs.forEach(setListener);    
}); 