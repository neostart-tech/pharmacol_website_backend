// Scroll to top button
function scrollToTop(){
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Scroll to top button
    const btn = document.getElementById('scrollToTopBtn');
    if (btn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                btn.classList.remove('hidden');
                btn.classList.add('flex');
            } else {
                btn.classList.add('hidden');
                btn.classList.remove('flex');
            }
        });
    }

    // The content will be loaded from the prestation.blade.php template
    // This keeps the JS file clean and allows for easy translation management

    //----------------------

    function toggleAccordion(button) {
        const content = button.nextElementSibling;
        const plus = button.querySelector('.plus');
        const minus = button.querySelector('.minus');
        content.classList.toggle('open');
        if (content.classList.contains('open')){
            content.style.maxHeight = content.scrollHeight + "px";
            plus.classList.add('hidden');
            minus.classList.remove('hidden');
        } else{
            content.style.maxHeight = null;
            plus.classList.remove('hidden');
            minus.classList.add('hidden');
        }
    }

    window.addEventListener("load", () => {
        document.querySelectorAll('.accordion-content').forEach(c => {
            c.style.maxHeight = null;
        });
    });



    //----------------------
    function searchCards(){
        const input = document.getElementById("searchInput").value.toLowerCase();
        const cards = document.getElementsByClassName("prestation");
        for (let card of cards){
            const title = card.getElementsByTagName("h3")[0].innerText.toLowerCase();
            const description = card.getElementsByTagName("p")[0].innerText.toLowerCase();

            if (title.includes(input) || description.includes(input)){
                card.style.display = "block";
            } else{
                card.style.display = "none";
            }
        }
    }

    // ----- ----- Barre de Recherche ----- -----
        // Note: These section names should be updated to use translations
        // For now they remain as-is for backwards compatibility
        const sections = {
            "": ["Accueil", "À propos de nous", "Home", "About us"],
            "togo": ["À propos de Pharmacol Togo", "Togo", "Chiffres Togo", "Carte Togo", "About Pharmacol Togo"],
            "benin": ["À propos de Pharmacol Bénin", "Bénin", "Chiffres Bénin", "Carte Bénin", "About Pharmacol Benin"],
            "niger": ["À propos de Pharmacol Niger", "Niger", "Chiffres Niger", "Carte Niger", "About Pharmacol Niger"],
            "prestation": ["Prestations", "Services"],
            "recrutement": ["Offres", "Recrutement", "Careers"],
            "blog": ["Articles", "Blog"],
            "contact": ["Carte", "Contact", "Map"]
        };

        const flatSections = Object.entries(sections).flatMap(([page, ids]) =>
            ids.map(id => ({ page, id }))
        );

        function toggleSearch() {
            const input = document.getElementById("searchInput");
            input.classList.toggle("hidden");
            if (!input.classList.contains("hidden")) {
                input.focus();
            } else {
                hideSuggestions();
            }
        }

        function updateSuggestions() {
            const query = document.getElementById("searchInput").value.toLowerCase().trim();
            const suggestionsContainer = document.getElementById("suggestions");

            suggestionsContainer.innerHTML = '';

            if (!query) {
                suggestionsContainer.classList.add("hidden");
                return;
            }

            const filtered = flatSections.filter(s =>
                s.id.toLowerCase().includes(query)
            );

            if (filtered.length === 0) {
                suggestionsContainer.classList.add("hidden");
                return;
            }

            filtered.forEach(s => {
                const li = document.createElement("li");
                li.className = "px-4 py-2 hover:bg-gray-200 cursor-pointer";
                li.textContent = s.id;
                li.onclick = () => {
                    window.location.href = `/${s.page}#${s.id}`;
                };
                suggestionsContainer.appendChild(li);
            });

            suggestionsContainer.classList.remove("hidden");
        }

        function performSearch() {
            const query = document.getElementById("searchInput").value.toLowerCase().trim();

            const result = flatSections.find(s => s.id.toLowerCase().includes(query));
            if (result) {
                window.location.href = `/${result.page}#${result.id}`;
            } else {
                // Use a generic message that works in both languages
                alert("No section found. / Aucune section trouvée.");
            }
        }

        function hideSuggestions() {
            const suggestionsContainer = document.getElementById("suggestions");
            suggestionsContainer.classList.add("hidden");
        }

        document.addEventListener("click", function (e) {
            const searchBox = document.getElementById("searchInput");
            const suggestions = document.getElementById("suggestions");
            if (!searchBox.contains(e.target) && !suggestions.contains(e.target)) {
                hideSuggestions();
            }
        });
        
    // Lier la recherche
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("input", updateSuggestions);
        searchInput.addEventListener("keydown", function(e) {
            if (e.key === "Enter") performSearch();
        });
    }

    // Note: showContent is defined in prestation.blade.php for the services page
    // It will be available when that page is loaded

    // Menu burger responsive
    const menuToggle = document.getElementById('menu-toggle');
    const mainMenu = document.getElementById('main-menu');
    if (menuToggle && mainMenu) {
        menuToggle.addEventListener('click', () => {
            mainMenu.classList.toggle('hidden');
        });
    }
});