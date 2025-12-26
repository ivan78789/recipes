export default function SearchModal() {
    return {
        isOpen: false,
        searchQuery: "",
        filters: {
            category: "",
            time: "",
            difficulty: "",
            cuisine: "",
        },
        isLoading: false,

        open() {
            this.isOpen = true;
            document.body.style.overflow = "hidden"; // блокируем скролл
            setTimeout(() => {
                this.$refs.searchInput?.focus();
            }, 100);
        },

        close() {
            this.isOpen = false;
            document.body.style.overflow = "";
        },

        performSearch() {
            if (!this.searchQuery.trim()) return;

            this.isLoading = true;

            // AJAX запрос к Laravel
            fetch(
                `/api/search?q=${encodeURIComponent(
                    this.searchQuery
                )}&${this.buildQueryString()}`
            )
                .then((response) => response.json())
                .then((data) => {
                    // Обработка результатов
                    console.log("Search results:", data);
                    // Можно emit событие или обновить результаты
                })
                .catch((error) => {
                    console.error("Search error:", error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },

        buildQueryString() {
            const params = new URLSearchParams();
            Object.entries(this.filters).forEach(([key, value]) => {
                if (value) params.append(key, value);
            });
            return params.toString();
        },

        clearFilters() {
            this.filters = {
                category: "",
                time: "",
                difficulty: "",
                cuisine: "",
            };
            this.searchQuery = "";
        },
    };
    
}
