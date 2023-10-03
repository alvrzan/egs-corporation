@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.admin.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    .custom-table td:first-child {
        width: 30%;
        border: none;
    }
    .edit-icon {
        cursor: pointer;
        color: #007bff;
    }
    .edit-field {
        display: none;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white">ADMIN PAGE</div>

                <div class="card-body">
                    <h4 class="mb-4">Your Biodata:</h4>
                    <table class="table custom-table">
                        <tbody>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>
                                    <span id="email">{{ Auth::user()->email }}</span>
                                    <i class="fas fa-pencil-alt edit-icon" data-field="email"></i>
                                    <input type="text" class="edit-field" id="email-input" data-field="email">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td>
                                    <span id="username">{{ Auth::user()->username }}</span>
                                    <i class="fas fa-pencil-alt edit-icon" data-field="username"></i>
                                    <input type="text" class="edit-field" id="username-input" data-field="username">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Phone Number:</strong></td>
                                <td>
                                    <span id="phone_number">{{ Auth::user()->phone_number }}</span>
                                    <i class="fas fa-pencil-alt edit-icon" data-field="phone_number"></i>
                                    <input type="text" class="edit-field" id="phone_number-input" data-field="phone_number">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Country:</strong></td>
                                <td>
                                    <span id="country">{{ Auth::user()->country }}</span>
                                    <i class="fas fa-pencil-alt edit-icon" data-field="country"></i>
                                    <input type="text" class="edit-field" id="country-input" data-field="country">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to toggle between text and input fields
    function toggleEditField(field) {
        const span = document.getElementById(field);
        const input = document.getElementById(`${field}-input`);
        span.style.display = "none";
        input.style.display = "block";
        input.value = span.textContent;
        input.focus();
    }

    // Event listener for clicking the edit icon
    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', (event) => {
            const field = event.target.getAttribute('data-field');
            toggleEditField(field);
        });
    });

    // Event listener for input fields to save changes
    document.querySelectorAll('.edit-field').forEach(input => {
        input.addEventListener('blur', (event) => {
            const field = event.target.getAttribute('data-field');
            const span = document.getElementById(field);
            const newValue = input.value;
            span.textContent = newValue;
            span.style.display = "inline";
            input.style.display = "none";
            // Anda juga bisa mengirimkan nilai yang diperbarui ke server untuk disimpan.
        });
    });
</script>
@endsection
