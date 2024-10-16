document.querySelectorAll('.text-input-container .input-field').forEach((inputField, index) => {
    inputField.addEventListener('focus', () => {
        document.querySelectorAll('.text-editor')[index].classList.remove('hidden');
        document.querySelectorAll('.text-input-container')[index].classList.add('hidden');
    });
});

function cancelPost(button) {
    const editor = button.closest('.text-editor');
    const index = Array.from(document.querySelectorAll('.text-editor')).indexOf(editor);
    document.querySelectorAll('.text-editor')[index].classList.add('hidden');
    document.querySelectorAll('.text-input-container')[index].classList.remove('hidden');
}

function postAnnouncement() {
    // Implement your post announcement logic here
    alert('Announcement posted');
}

// Updated `formatText` function without `execCommand`
function formatText(command) {
    const selection = window.getSelection();
    if (!selection.rangeCount) return;
    const range = selection.getRangeAt(0);

    const span = document.createElement('span');
    switch (command) {
        case 'bold':
            span.style.fontWeight = 'bold';
            break;
        case 'italic':
            span.style.fontStyle = 'italic';
            break;
        case 'underline':
            span.style.textDecoration = 'underline';
            break;
        default:
            console.warn('Unknown command');
            return;
    }
    
    range.surroundContents(span);
}

// Example usage of `formatText`
document.getElementById('boldButton').addEventListener('click', function() {
    formatText('bold');
});

function addGoogleDriveFile() {
    // Implement your Google Drive file addition logic here
    alert('Add Google Drive File');
}

function addYouTubeVideo() {
    // Implement your YouTube video addition logic here
    alert('Add YouTube Video');
}

function moveLine(tab) {
    var forumTab = document.getElementById("forumTab");
    var nilaiTab = document.getElementById("nilaiTab");

    if (tab === 'forum') {
        forumTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        forumTab.classList.remove("font-medium");
        nilaiTab.classList.add("font-medium");
        nilaiTab.classList.remove("font-bold", "border-b-2", "border-blue-500");
    } else if (tab === 'nilai') {
        nilaiTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        nilaiTab.classList.remove("font-medium");
        forumTab.classList.add("font-medium");
        forumTab.classList.remove("font-bold", "border-b-2", "border-blue-500");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    moveLine('forum');
});

function switchTab(tab) {
    var forumTab = document.getElementById("forumTab");
    var nilaiTab = document.getElementById("nilaiTab");
    var forumContent = document.getElementById("forumContent");
    var nilaiContent = document.getElementById("nilaiContent");

    if (tab === 'forum') {
        forumTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        forumTab.classList.remove("font-medium");
        nilaiTab.classList.add("font-medium");
        nilaiTab.classList.remove("font-bold", "border-b-2", "border-blue-500");

        forumContent.classList.remove("hidden");
        nilaiContent.classList.add("hidden");
    } else if (tab === 'nilai') {
        nilaiTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        nilaiTab.classList.remove("font-medium");
        forumTab.classList.add("font-medium");
        forumTab.classList.remove("font-bold", "border-b-2", "border-blue-500");

        nilaiContent.classList.remove("hidden");
        forumContent.classList.add("hidden");
    }
}
