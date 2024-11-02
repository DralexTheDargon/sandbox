<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./resources/css/app.css">
</head>
<body class="bg-light p-5">

<div class="container">
    <h1 class="text-primary mb-4">Manage FAQs</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- List All FAQs -->
    <div class="mb-4">
        <h3>All FAQs</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="showEditForm({{ $faq->id }}, '{{ $faq->question }}', '{{ $faq->answer }}')">Edit</button>
                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(this.form)">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create New FAQ Form -->
    <div id="createForm">
        <h3>Add New FAQ</h3>
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Question</label>
                <input type="text" name="question" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Answer</label>
                <textarea name="answer" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <!-- Edit FAQ Form (Hidden by Default) -->
    <div id="editForm" style="display: none;">
        <h3>Edit FAQ</h3>
        <form id="editFaqForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label>Question</label>
                <input type="text" id="editQuestion" name="question" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Answer</label>
                <textarea id="editAnswer" name="answer" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" onclick="hideEditForm()">Cancel</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete(form){
        if(confirm("Are you sure you want to delete this question?")){
            form.submit();
        }
    }
</script>
<script>
    function showEditForm(id, question, answer) {
        document.getElementById('createForm').style.display = 'none';
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('editFaqForm').action = `/admin/faqs/${id}`;
        document.getElementById('editQuestion').value = question;
        document.getElementById('editAnswer').value = answer;
    }

    function hideEditForm() {
        document.getElementById('editForm').style.display = 'none';
        document.getElementById('createForm').style.display = 'block';
    }
</script>

</body>
</html>