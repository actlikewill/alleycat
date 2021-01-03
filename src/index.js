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

jQuery(document).ready(($) => {
    $(document).on('click', '.js-image-upload', (e) => {
        e.preventDefault();
        const $button = $(this);
        const file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or Upload an Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Select Image'
            },
            multiple: false
        });
        file_frame.on('select', () => {
            const attachment = file_frame.state().get('selection').first().toJSON();
            $button.siblings('.image-upload').val(attachment.url);
        });
        file_frame.open();
    });
});