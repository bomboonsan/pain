<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}


        {{-- Selected --}}
        <div class="px-3 w-full mb-5">
            <p class="font-bold">
                ยาที่ได้รับ
            </p>
            <div class=" p-2 bg-neutral-100 rounded-md">

                @if(count($selected) > 0)
                <div class="space-y-2">
                    @forelse($selected as $list)
                        <label for="{{ $list['id'] ?? '' }}" class="flex justify-between p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="text-lg">{{ $list['name'] ?? '' }}</span>
                            <button type="button" wire:click="remove({{ $list['id'] ?? '' }})">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 0.25C4.624 0.25 0.25 4.624 0.25 10C0.25 15.376 4.624 19.75 10 19.75C15.376 19.75 19.75 15.376 19.75 10C19.75 4.624 15.376 0.25 10 0.25ZM10 1.75C14.5653 1.75 18.25 5.43475 18.25 10C18.25 14.5653 14.5653 18.25 10 18.25C5.43475 18.25 1.75 14.5653 1.75 10C1.75 5.43475 5.43475 1.75 10 1.75ZM5.5 9.25V10.75H14.5V9.25H5.5Z" fill="#ED6F7D"/>
                                </svg>
                            </button>
                        </label>
                    @empty
                        <p class="text-gray-500">ยังไม่ได้เลือกยา</p>
                    @endforelse
                </div>
                @else
                    <p class="text-red-400 text-center">ไม่พบยาที่ได้รับ</p>
                @endif
            </div>
        </div>

        <div class="px-3 w-full mb-5">
            <label for="search" class="pl-1 font-bold">ค้นหาชื่อยา</label>
            <div class="flex items-stretch relative">
                <input
                type="text"
                class="p-1 px-4 w-full min-h-[1.5rem] border border-primary/70 focus:border-primary focus:ring-primary rounded-lg font-light text-sm transition-all"
                placeholder="ค้นหา"
                id="search"
                wire:model="name"
                {{-- wire:keydown.enter="search" --}}
                wire:input="search"
                />
                <button type="submit" class="inline-block absolute right-[5px] top-1/2 -translate-y-1/2" wire:click="search">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.125 16.7188L13.2781 11.8711C14.0592 10.7977 14.4794 9.50407 14.4781 8.17656C14.4781 4.70195 11.6512 1.875 8.17656 1.875C4.70195 1.875 1.875 4.70195 1.875 8.17656C1.875 11.6512 4.70195 14.4781 8.17656 14.4781C9.50407 14.4794 10.7977 14.0592 11.8711 13.2781L16.7188 18.125L18.125 16.7188ZM8.17656 12.4879C7.32375 12.488 6.49007 12.2351 5.78095 11.7614C5.07183 11.2877 4.51913 10.6143 4.19274 9.82638C3.86635 9.0385 3.78093 8.17152 3.94728 7.33509C4.11364 6.49866 4.5243 5.73035 5.12733 5.12733C5.73035 4.5243 6.49866 4.11364 7.33509 3.94728C8.17152 3.78093 9.0385 3.86635 9.82638 4.19274C10.6143 4.51913 11.2877 5.07183 11.7614 5.78095C12.2351 6.49007 12.488 7.32375 12.4879 8.17656C12.4865 9.31959 12.0319 10.4154 11.2236 11.2236C10.4154 12.0319 9.31959 12.4865 8.17656 12.4879Z" fill="#9ED0CA"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Result --}}
        <div class="px-3 w-full mb-5 @if(count($lists) == 0) hidden @endif">
            <p class="font-bold">
                ผลการค้นหา
            </p>
            @if(count($lists) > 0)
            <div class="space-y-2">
                @foreach($lists as $list)
                    <label for="{{ $list['id'] ?? '' }}" class="flex justify-between p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="text-lg">{{ $list['name'] ?? '' }}</span>
                        <button type="button" wire:click="add({{ $list['id'] ?? '' }})">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 0.25C4.624 0.25 0.25 4.624 0.25 10C0.25 15.376 4.624 19.75 10 19.75C15.376 19.75 19.75 15.376 19.75 10C19.75 4.624 15.376 0.25 10 0.25ZM10 1.75C14.5653 1.75 18.25 5.43475 18.25 10C18.25 14.5653 14.5653 18.25 10 18.25C5.43475 18.25 1.75 14.5653 1.75 10C1.75 5.43475 5.43475 1.75 10 1.75ZM9.25 5.5V9.25H5.5V10.75H9.25V14.5H10.75V10.75H14.5V9.25H10.75V5.5H9.25Z" fill="#9ED0CA"/>
                            </svg>
                        </button>
                    </label>
                @endforeach
            </div>
            @endif
        </div>

</div>
