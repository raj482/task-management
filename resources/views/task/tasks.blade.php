<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                    <button id="addTaskBtn"  data-action="add" class="px-4 py-1 text-xs text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">
                        <svg
                            class="inline-block w-4 h-4 align-middle"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2C11.4477 2 11 2.44772 11 3V11H3C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11V21C11 21.5523 11.4477 22 12 22C12.5523 22 13 21.5523 13 21V13H21C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11H13V3C13 2.44772 12.5523 2 12 2Z"
                                fill="currentColor"/>
                        </svg>
                        <span class="inline-block align-middle ml-1">Add Task</span>
                    </button>
                    <div class="grid grid-cols-4 gap-4 mt-2" id="taskCardGrid">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteTaskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-500">
            <div class="px-4 pt-2 pb-2 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mt-3  text-center sm:mt-0  sm:text-center">
                        <div class="mt-2">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-3">Are you sure want to delete ?</h3>
                            <input type="hidden" id="deleteTaskId">
                            <input type="hidden" id="deleteToken" value="{{csrf_token()}}">
                            <button class="px-4 py-1 text-xs text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" id="deleteYesTaskBtn">Yes</button>
                            <button class="px-4 py-1 text-xs text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" id="deleteNoTaskBtn">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="taskDetailModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 pt-2 pb-2 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mt-3  text-left sm:mt-0  sm:text-left">
                        <div class="mt-2">
                            <div class="mb-4">
                                <h1 id="detail-title" class="font-bold text-base"></h1>
                                <p id="detail-description" class=""></p>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="closeTaskDetailBtn"  class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Close</button>
            </div>
        </div>
    </div>
    @include('task.partials.add-task-modal')
</x-app-layout>
