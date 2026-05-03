<div class="flex justify-center items-center gap-6 mb-4 pb-4 border-b-2 border-slate-100 dark:border-slate-700">
    <div class="relative group">
        <div :class="photoDirty ? 'border-orange-400 bg-orange-50 dark:bg-orange-900/20' : 'border-gray-400 dark:border-gray-600 bg-slate-50 dark:bg-slate-900'" class="h-[8rem] w-[8rem] rounded-2xl overflow-hidden border-2 shadow-sm transition-colors duration-300">
            <template x-if="previewUrl">
                <img :src="previewUrl" class="w-full h-full object-cover">
            </template>

            <template x-if="!previewUrl">
                <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-600">
                    <i class="fas fa-user-circle text-7xl"></i>
                </div>
            </template>
        </div>

        <template x-if="previewUrl">
            <button type="button" @click="removeImage()" class="absolute -bottom-2 -right-2 bg-red-600 text-white w-8 h-8 flex items-center justify-center rounded-lg cursor-pointer hover:scale-110 transition-transform shadow-md">
                <i class="fas fa-trash-can text-sm"></i>
            </button>
        </template>

        <template x-if="!previewUrl">
            <label class="absolute -bottom-2 -right-2 bg-blue-600 text-white w-8 h-8 flex items-center justify-center rounded-lg cursor-pointer hover:scale-110 transition-transform shadow-md">
                <i class="fas fa-pencil text-sm"></i>
                <input type="file" name="profilePicture" id="profilePictureFileInput" class="hidden" accept="image/*" @change="previewImage($event)">
            </label>
        </template>
    </div>

    <div class="ml-4">
        <h2 class="text-[1.5rem] font-bold text-slate-800 dark:text-white transition-colors duration-300">{{ $title }}</h2>
        <p class="text-base text-slate-500 dark:text-slate-400 mt-1 font-medium transition-colors duration-300">{{ $description }}</p>
    </div>
</div>
