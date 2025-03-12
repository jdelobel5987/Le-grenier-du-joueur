const tabLinks = document.querySelectorAll(".tabLink");
const tabContents = document.querySelectorAll(".tabContent");

function displayTabContent(targetId) {

    tabContents.forEach(content => {
        content.style.display = "none";
    });

    tabLinks.forEach(link => {
        link.classList.remove('active');
    });

    const targetContent = document.getElementById(targetId);
    if(targetContent) {
        targetContent.style.display = "block";
    }

    const activeTab = [...tabLinks].find(link => link.dataset.target === targetId);
    if(activeTab) {
        activeTab.classList.add('active');
    }
}

tabLinks.forEach(button => { 
    button.addEventListener('click', () => {
        const targetId = button.dataset.target;
        displayTabContent(targetId);
    });
});

if(tabLinks.length > 0) {
    const firstTabId = tabLinks[0].dataset.target;
    displayTabContent(firstTabId);
}