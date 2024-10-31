async function fetchArticles(type = 'recent', category = null, page = 1) {
    try {
        const url = `get_articles.php?type=${type}&category=${category}&page=${page}`;
        const response = await fetch(url);
        
        // Pastikan response berhasil
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const articles = await response.json();

        // Pilih elemen berdasarkan tipe untuk most recent atau trending
        let postList = document.getElementById(type === 'popular' ? 'trending-list' : 'post-list');
        postList.innerHTML = ''; // Kosongkan konten sebelumnya

        articles.forEach(article => {
            let post = document.createElement('div');
            post.classList.add('post');
            post.innerHTML = `<h3>${article.title}</h3><p>${article.content.substring(0, 100)}...</p>`;
            postList.appendChild(post);
        });
    } catch (error) {
        console.error("Error fetching articles:", error);
    }
}

// Panggil fetchArticles untuk artikel terbaru dan terpopuler
document.addEventListener("DOMContentLoaded", async function() {
    await fetchArticles('recent', 2); // Menampilkan artikel terbaru
    await fetchArticles('popular', 2); // Menampilkan artikel terpopuler
});
