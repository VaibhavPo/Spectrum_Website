    console.log("The url sent=",pdfUrl)
    const pdfContainer = document.getElementById('pdf-container');
    const prevPageButton = document.getElementById('prev-page');
    const nextPageButton = document.getElementById('next-page');
    const zoomInButton = document.getElementById('zoom-in');
    const zoomOutButton = document.getElementById('zoom-out');
    const openButton = document.getElementById('open');
    const fileHolder = document.getElementById('file');
    const pgnoBtn = document.getElementById('pageno');


    let pdfInstance = null;
    let currentPage = 1;
    let currentScale = 1.0;
    const updatePageTextbox = () => {
      pgnoBtn.value = currentPage;
    };
    

    // Load PDF document
    const loadPDF = async (url) => {
      const loadingTask = pdfjsLib.getDocument(url);
      pdfInstance = await loadingTask.promise;
      renderPage(currentPage);
    };

    // Render a specific page
    const renderPage = (pageNumber) => {
      pdfInstance.getPage(pageNumber).then(page => {
        const viewport = page.getViewport({ scale: currentScale });
        const canvas = document.createElement('canvas');
        canvas.width = viewport.width;
        canvas.height = viewport.height;
        const context = canvas.getContext('2d');
        const renderContext = {
          canvasContext: context,
          viewport: viewport,
          renderingIntent: 'print',
        };
        pdfContainer.innerHTML = '';
        pdfContainer.appendChild(canvas);
        page.render(renderContext);
      });
    };

    // Event listeners for buttons
    prevPageButton.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        renderPage(currentPage);
        updatePageTextbox();
      }
    });

    nextPageButton.addEventListener('click', () => {
      if (currentPage < pdfInstance.numPages) {
        currentPage++;
        renderPage(currentPage);
        updatePageTextbox();
      }
    });

    zoomInButton.addEventListener('click', () => {
      currentScale += 0.1;
      renderPage(currentPage);
    });

    zoomOutButton.addEventListener('click', () => {
      if (currentScale > 0.2) {
        currentScale -= 0.1;
        renderPage(currentPage);
      }
    });
    pgnoBtn.addEventListener('keyup', event => {
      if (event.key == 'Enter') {
        const newPage = parseInt(pgnoBtn.value);
        if (!isNaN(newPage) && newPage >= 1 && newPage <= pdfInstance.numPages) {
          currentPage = newPage;
          renderPage(currentPage);
          updatePageTextbox();
        }
      }
    });

    window.addEventListener('load', () => {
      
      loadPDF(pdfUrl);
      console.log("opening the:",'PDF/'+pdfUrl);
      updatePageTextbox();
    });
  
