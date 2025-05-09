<button type="button" class="btn btn-primary createButton">Create Quote</button>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.createButton').addEventListener('click', function () {
        // Create an XHR object
        var xhr = new XMLHttpRequest();

        // Define the request type, URL, and whether it should be asynchronous
        xhr.open('POST', '{{ route('quote.createQuote') }}', true);

        // Set the request header to send form data
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle the success response, if needed
                    console.log(xhr.responseText);
                } else {
                    // Handle the error response
                    console.error('Error:', xhr.status);
                }
            }
        };

        // Get the form data
        var formData = new FormData();

        // Add form field data to the form data
        formData.append('customer', document.querySelector('[name="customer"]').value);
        formData.append('issue_date', document.querySelector('[name="issue_date"]').value);
        formData.append('expiry_date', document.querySelector('[name="expiry_date"]').value);
        formData.append('quote_number', document.querySelector('[name="quote_number"]').value);
        formData.append('title', document.querySelector('[name="title"]').value);
        formData.append('summary', document.querySelector('[name="summary"]').value);
        formData.append('reference', document.querySelector('[name="reference"]').value);
        formData.append('currency', document.querySelector('[name="currency"]').value);
        formData.append('project', document.querySelector('[name="project"]').value);
        formData.append('tax', document.querySelector('[name="tax"]').value);
        formData.append('terms', document.querySelector('[name="terms"]').value);
        formData.append('subtotal', document.querySelector('[name="subtotal"]').value);
        formData.append('total', document.querySelector('[name="total"]').value);
        // Add other form fields as needed

        // Send the request with the form data
        xhr.send(formData);
    });
});

</script>