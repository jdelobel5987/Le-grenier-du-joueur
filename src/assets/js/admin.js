const tabLinks = document.querySelectorAll(".tabLink");
const subtabLinks = document.querySelectorAll(".subtabLink");
const tabContents = document.querySelectorAll(".tabContent");
const subtabContents = document.querySelectorAll(".subtabContent");

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

    const firstSubtabLink = targetContent.querySelector(".subtabLink");
    if(firstSubtabLink) {
        displaysubTabContent(firstSubtabLink.dataset.target);
    }
}

function displaysubTabContent(targetId) {

    subtabContents.forEach(content => {
        content.style.display = "none";
        content.classList.remove("active");
    });

    subtabLinks.forEach(link => {
        link.classList.remove("active");
    });

    const targetContent = document.querySelector(`#subtab-${targetId}`);
    if (targetContent) {
        targetContent.style.display = "block"; 
        targetContent.classList.add("active"); 
    }

    const activeSubtab = [...subtabLinks].find(link => link.dataset.target === targetId);
    if (activeSubtab) {
        activeSubtab.classList.add("active");
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

subtabLinks.forEach(button => { 
    button.addEventListener('click', () => {
        const targetId = button.dataset.target;
        console.log(`Sous-onglet cliqué : ${targetId}`); //journalisation
        displaysubTabContent(targetId);
    });
});

// Activer le premier sous-onglet pour l'onglet principal actif au chargement
const activeTabContent = document.querySelector(".tabContent:not([style*='display: none'])");
if (activeTabContent) {
    const firstSubtabLink = activeTabContent.querySelector(".subtabLink");
    if (firstSubtabLink) {
        displaysubTabContent(firstSubtabLink.dataset.target);
    }
}