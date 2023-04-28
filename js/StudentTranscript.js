function generatePDF() {
    const transcript = document.querySelector('.transcript-table');
    const pdf = new jsPDF('p', 'pt', 'a4');

    html2canvas(transcript).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save('StudentTranscript.pdf');
    });
}
