function showCreateClientModal() {
    document.getElementById('createclientModal').classList.remove('hidden');
    document.getElementById('createclientModal').classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function hideCreateClientModal() {
    document.getElementById('createclientModal').classList.add('hidden');
    document.getElementById('createclientModal').classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

function showUpdateClientModal() {
    document.getElementById('updateclientModal').classList.remove('hidden');
    document.getElementById('updateclientModal').classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function hideUpdateClientModal() {
    document.getElementById('updateclientModal').classList.add('hidden');
    document.getElementById('updateclientModal').classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

function showdeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function hidedeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}