import './bootstrap';


const returnedBtn = document.getElementById('returned');
const overdueBtn = document.getElementById('overdue');

returnedBtn?.addEventListener('click', function() {
    let loanId = this.getAttribute('data-loan-id');
    updateBookLoanStatus(loanId, 2);
})

overdueBtn?.addEventListener('click', function() {
    let loanId = this.getAttribute('data-loan-id');
    updateBookLoanStatus(loanId, 3);
})

function updateBookLoanStatus(loanId, statusId) {

    let url = `${window.Laravel.url}/book_loans/${loanId}`;

    const data = {
        id: loanId,
        book_status_id: statusId
    };

    axios.put(url, data, {
        headers: {
            'Content-Type': 'application/json',
            'Authorization':`Bearer ${window.Laravel.csrfToken}` 
        }
    })
    .then(response => {
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });

}