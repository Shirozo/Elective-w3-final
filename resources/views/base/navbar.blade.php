<nav class="custom-navbar">
    @yield("navbar-content")
</nav>


<script>
    function openModal(id) {
        var locModal = document.getElementById(id);
        locModal.style.display = "block";
    }
    const topics = document.querySelectorAll(".topic")

    topics.forEach(topic => {
        topic.addEventListener('click', function(e) {
            setNavActive(this); 
        });
    });

    const activeLinkText = localStorage.getItem('activeLink');
    
    if (activeLinkText) {
        const activeLink = Array.from(topics).find(topic => topic.textContent === activeLinkText);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }

    function setNavActive(activeLink) {
        topics.forEach(topic => topic.classList.remove('active'));
        activeLink.classList.add('active');
        
        localStorage.setItem('activeLink', activeLink.textContent);
    }
</script>
