<div x-data="{
    expanded: false,
    showFilters: false,
    searchQuery: '',
    filters: {
        category: '',
        time: '',
        difficulty: ''
    },
    
    init() {
        // Закрытие при клике вне компонента
        window.addEventListener('click', (e) => {
            if (this.expanded && !this.$el.contains(e.target)) {
                this.closeAll();
            }
        });
        
        // Отслеживаем изменение состояния
        this.$watch('expanded', (value) => {
            // Отправляем событие в навигацию
            this.$dispatch('search-expanded', value);
        });
    },
    
    toggleSearch() {
        this.expanded = !this.expanded;
        if (this.expanded) {
            setTimeout(() => this.$refs.searchInput.focus(), 100);
        } else {
            this.closeAll();
        }
    },
    
    openFilters(e) {
        e.stopPropagation(); // чтобы не закрывалось сразу
        this.showFilters = true;
    },
    
    closeAll() {
        this.expanded = false;
        this.showFilters = false;
        this.searchQuery = '';
    },
    
    clearFilters() {
        this.filters = {
            category: '',
            time: '',
            difficulty: ''
        };
    },
    
    performSearch() {
        if (this.searchQuery.trim()) {
            console.log('Search:', this.searchQuery, this.filters);
            this.closeAll();
        }
    }
}" class="relative">
    
    <button x-show="!expanded" @click="toggleSearch"
            class="text-gray-700 hover:text-red-500 transition-colors relative
                   after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 
                   after:bg-red-500 after:transition-all after:duration-300
                   hover:after:w-full p-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </button>
    
<div x-show="expanded" 
    x-transition:enter="transition-opacity duration-300 ease-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity duration-200 ease-in"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="w-full max-w-sm mx-auto">
        <div class="relative flex items-center">
                 <div class="flex-grow flex items-center bg-white rounded-full border border-gray-300 
                      shadow-sm px-4 py-2">
                  @include('components.icons.search', ['class' => 'w-5 h-5 text-gray-400 mr-2 flex-shrink-0'])
                  <input x-model="searchQuery" @click="openFilters($event)" x-ref="searchInput"
                      type="text" placeholder="Поиск рецептов..." 
                      class="flex-grow outline-none bg-transparent text-gray-800 
                          placeholder-gray-400 min-w-0 max-w-[220px]">
                
                <button @click="openFilters($event)" 
                        :class="showFilters ? 'text-red-500' : 'text-gray-400 hover:text-red-500'"
                        class="ml-2 p-1 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                </button>
                
                <!-- Кнопка закрытия -->
                <button @click="closeAll" 
                        class="ml-2 p-1 text-gray-400 hover:text-red-500 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div x-show="showFilters" x-transition
                 @click.stop
                 class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl 
                        border border-gray-200 p-4 z-50">
                
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-medium text-gray-900">Фильтры</h4>
                    <button @click="showFilters = false" class="text-gray-400 hover:text-gray-600">
                        ✕
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Категория</label>
                        <select x-model="filters.category" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">Все категории</option>
                            <option value="breakfast">Завтрак</option>
                            <option value="lunch">Обед</option>
                            <option value="dinner">Ужин</option>
                            <option value="dessert">Десерт</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Время (мин)</label>
                        <select x-model="filters.time" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">Любое время</option>
                            <option value="15">≤ 15 мин</option>
                            <option value="30">≤ 30 мин</option>
                            <option value="60">≤ 60 мин</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Сложность</label>
                        <div class="flex gap-2">
                            <button @click="filters.difficulty = 'easy'" 
                                    :class="filters.difficulty === 'easy' 
                                            ? 'bg-green-100 text-green-800 border-green-300' 
                                            : 'bg-gray-100 text-gray-700 border-gray-300'"
                                    class="flex-1 py-1.5 text-xs rounded-lg border">
                                Легко
                            </button>
                            <button @click="filters.difficulty = 'medium'"
                                    :class="filters.difficulty === 'medium' 
                                            ? 'bg-yellow-100 text-yellow-800 border-yellow-300' 
                                            : 'bg-gray-100 text-gray-700 border-gray-300'"
                                    class="flex-1 py-1.5 text-xs rounded-lg border">
                                Средне
                            </button>
                            <button @click="filters.difficulty = 'hard'"
                                    :class="filters.difficulty === 'hard' 
                                            ? 'bg-red-100 text-red-800 border-red-300' 
                                            : 'bg-gray-100 text-gray-700 border-gray-300'"
                                    class="flex-1 py-1.5 text-xs rounded-lg border">
                                Сложно
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-2 mt-6">
                    <button @click="clearFilters" 
                            class="flex-1 py-2 text-sm border border-gray-300 rounded-lg 
                                   hover:bg-gray-50">
                        Сбросить
                    </button>
                    <button @click="performSearch"
                            class="flex-1 py-2 text-sm bg-red-500 text-white rounded-lg 
                                   hover:bg-red-600">
                        Применить
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>