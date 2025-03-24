<div>
    <h2 class="text-xl font-semibold mb-4">Password Details</h2>

    <p><strong>Username:</strong> {{ $password->username }}</p>
    <button onclick="copyToClipboard('{{ $password->username }}')">Copy Username</button>

    <p><strong>Password:</strong> {{ $password->password }}</p>
    <button onclick="copyToClipboard('{{ $password->password }}')">Copy Password</button>

    <p><strong>Link:</strong> <a href="{{ $password->link }}" target="_blank">{{ $password->link }}</a></p>
    <button onclick="copyToClipboard('{{ $password->link }}')">Copy Link</button>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        alert('Copied to clipboard!');
    }
</script>
