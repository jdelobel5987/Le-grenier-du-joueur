////////////////////////////////////////////////////////////
// display specific content based on selected tab/sub-tab //
////////////////////////////////////////////////////////////

// elements selection
const tabLinks = document.querySelectorAll(".tabLink"); // tab buttons
const subtabLinks = document.querySelectorAll(".subtabLink"); // sub-tab buttons
const tabContents = document.querySelectorAll(".tabContent"); // tab contents
const subtabContents = document.querySelectorAll(".subtabContent"); // sub-tab contents

// tab selection and content display
function displayTabContent(targetId) {
    // hide all tab contents
    tabContents.forEach(content => {
        content.style.display = "none";
    });

    // remove active class from all tab links
    tabLinks.forEach(link => {
        link.classList.remove('active');
    });

    // display selected tab content
    const targetContent = document.getElementById(targetId);
    if(targetContent) {
        targetContent.style.display = "block";
    }

    // add active class to selected tab link
    const activeTab = [...tabLinks].find(link => link.dataset.target === targetId);
    if(activeTab) {
        activeTab.classList.add('active');
    }
    
    // auto-display sub-tab content when a sub-tab is selected
    const hash = window.location.hash.substring(1);
    const [tabId, subtabId] = hash.split('-');
    if (subtabId) {
        displaysubTabContent(subtabId);
    } else {
        const firstSubtabLink = targetContent.querySelector(".subtabLink");
        if (firstSubtabLink) {
            displaysubTabContent(firstSubtabLink.dataset.target);
        }
    }
}

// sub-tab selection and content display
function displaysubTabContent(targetId) {
    // hide all sub-tab contents
    subtabContents.forEach(content => {
        content.style.display = "none";
        content.classList.remove("active");
    });

    // remove active class from all sub-tab links
    subtabLinks.forEach(link => {
        link.classList.remove("active");
    });

    // display selected sub-tab content and add active class
    const targetContent = document.querySelector(`#subtab-${targetId}`);
    if (targetContent) {
        targetContent.style.display = "block"; 
        targetContent.classList.add("active"); 
    }

    // add active class to selected sub-tab link
    const activeSubtab = [...subtabLinks].find(link => link.dataset.target === targetId);
    if (activeSubtab) {
        activeSubtab.classList.add("active");
    }
}

// listener for tab change (attribute an url hash for further reload purpose)
tabLinks.forEach(button => { 
    button.addEventListener('click', () => {
        const targetId = button.dataset.target;
        window.location.hash = targetId;
        displayTabContent(targetId);
    });
});

// listener for subtab change (update url hash for reload on same tab/subtab when needed)
subtabLinks.forEach(button => { 
    button.addEventListener('click', () => {
        const targetId = button.dataset.target;
        const currentTab = window.location.hash.split('-')[0];
        window.location.hash = `${currentTab}-${targetId}`;
        displaysubTabContent(targetId);
    });
});

// On page load, display tab & subtab based on hash in URL (manage page reload on game selection in update product tab)
window.addEventListener('load', () => {
    const hash = window.location.hash.substring(1); // Remove starting #
    if (hash) {
        const [tabId, subtabId] = hash.split('-');  // Separate tab and subtab
        displayTabContent(tabId);
        if (subtabId) {
            displaysubTabContent(subtabId);
        }
    } else {
        // Default: display 1st tab and 1st subtab
        const firstTabId = tabLinks[0].dataset.target;
        displayTabContent(firstTabId);
    }
});

// Auto-completion of update form fields on game selection in updateProduct tab
const updateProductForm = document.getElementById('updateProductForm');
if (updateProductForm) {
    const gameSelect = document.getElementById('id_games');
    if (gameSelect) {
        gameSelect.addEventListener('change', (event) => {
            event.preventDefault();
            updateProductForm.submit();
        });
    } else {
        console.error('Sélecteur de jeu introuvable.');
    }
}
