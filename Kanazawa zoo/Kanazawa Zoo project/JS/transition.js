document.addEventListener('DOMContentLoaded', () => {
    // Check if view transitions are supported
    if ('viewTransition' in document.documentElement) {
  
      // Function to handle page navigation with transition
      function handleNavigation(event) {
        const link = event.target;
        const href = link.getAttribute('href');
  
        // Ensure the link is not an external link
        if (href && !href.startsWith('http')) {
          event.preventDefault(); // Prevent the default anchor link behavior
  
          // Add transition class to the body (trigger transition)
          document.body.classList.add('view-transition');
  
          // Use history.pushState to update the browser's history and prevent page reload
          history.pushState({ path: href }, '', href);
  
          // Wait for the transition to finish before loading the new content
          setTimeout(() => {
            // Load the new page content
            loadNewPage(href);
          }, 1000); // Match this duration with your transition duration (in ms)
        }
      }
  
      // Function to load new content without reloading the page (using AJAX or similar)
      function loadNewPage(href) {
        fetch(href)
          .then(response => response.text())
          .then(html => {
            // Create a temporary div to hold the new page content
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
  
            // Extract the main content from the new page
            const newBody = tempDiv.querySelector('body');
            const newMainContent = newBody.querySelector('.main');
  
            // Replace the current page's main content with the new content
            document.querySelector('.main').innerHTML = newMainContent.innerHTML;
  
            // Trigger a reflow/repaint to ensure the content is displayed properly
            document.body.classList.remove('view-transition');
          })
          .catch(err => {
            console.error('Error loading new page:', err);
          });
      }
  
      // Set up link navigation to trigger page transition
      const links = document.querySelectorAll('a');
      links.forEach(link => {
        link.addEventListener('click', handleNavigation);
      });
  
      // Handle back/forward navigation (when history changes)
      window.addEventListener('popstate', () => {
        // Trigger transition and load the correct page based on the URL
        document.body.classList.add('view-transition');
        loadNewPage(location.pathname); // Load the current page based on the URL
      });
  
    }
  });
  