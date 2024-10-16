function createNavBar() {
    const navBarHTML = `
    <nav class="flex w-full justify-between items-center py-3 px-8 border-b border-black">
    <div class="flex gap-4 justify-between items-center">
        <button type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" />
            </svg>
        </button>
        <h1 class="font-semibold text-2xl">Name</h1>
    </div>
    <div class="flex gap-4 justify-between items-center">
        <button type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bell">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
            </svg>
        </button>
        <div class="flex flex-col">
            <div class="flex gap-3 justify-between items-center" id="Account">
                <p>Nama Akun</p>
                <img src="assets/user.png" class="w-10 h-10 cursor-pointer" id="accountImage">
            </div>
            <div class="relative">
                <div id="dropdownMenu" class="hidden bg-gray-100 p-2 w-full rounded-lg absolute right-0 mt-2">
                    <button class="p-2 bg-red-500 text-white font-medium w-full rounded-lg">Log out</button>
                </div>
            </div>
        </div>
    </div>
</nav>
    `;

    return navBarHTML;
}

// Event listener untuk menampilkan dropdown
document.addEventListener('DOMContentLoaded', () => {
    const navContainer = document.getElementById('navContainer');
    if (navContainer) {
        navContainer.innerHTML = createNavBar();
        
        // Tambahkan event listener setelah elemen dimasukkan ke dalam DOM
        const accountImage = document.getElementById('accountImage');
        if (accountImage) {
            accountImage.addEventListener('click', () => {
                const dropdown = document.getElementById('dropdownMenu');
                dropdown.classList.toggle('hidden');
            });
        }
    }
});
