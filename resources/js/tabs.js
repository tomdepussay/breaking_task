document.addEventListener('click', function(event){
    const trigger = event.target.closest('.tab');
    if(!trigger) return;

    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        if(tab === trigger){
            tab.classList.add('underline');
            tab.classList.add('bg-gray-100/50');
        } else {
            tab.classList.remove('underline');
            tab.classList.remove('bg-gray-100/50');
        }
    });

    const tabContainers = document.querySelectorAll('.tab-container');
    tabContainers.forEach(tabContainer => {
        if(tabContainer.id === trigger.getAttribute("data-tab")){
            tabContainer.classList.remove('hidden');
        } else {
            tabContainer.classList.add('hidden');
        }
    });

    const tabName = trigger.getAttribute("data-tab");
    const url = new URL(window.location);
    url.searchParams.set('tab', tabName);
    window.history.pushState({}, '', url);
});