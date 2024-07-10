<div id="addTaskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 pt-2 pb-2 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mt-3  text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900"></h3>
                        <p id="save-message" class="text-green-400"></p>
                        <div class="mt-2">
                            <form id="addTaskForm" action="#" method="POST">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="taskId" id="taskId" value="">
                                <div class="mb-4">
                                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                                    <input type="text" id="title" name="title" class="shadow  border rounded py-2 px-3 text-gray-700  focus:outline-none focus:shadow-outline w-full" >
                                    <p id="titleError" class="input-error text-red-400"></p>
                                </div>
                                <div class="mb-4 ">
                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                    <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" ></textarea>
                                    <p id="descriptionError" class="input-error text-red-400"></p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="mb-4">
                                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                                        <select id="status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                        <p id="statusError" class="input-error text-red-400"></p>
                                    </div>
                                    <div class="mb-4">
                                        <label for="user" class="block text-gray-700 text-sm font-bold mb-2">User</label>
                                        <select id="user" name="user_id" class="shadow appearance-none border rounded w-fit py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                            <option value="">Select User</option>
                                            <option value="5">User2</option>
                                        </select>
                                        <p id="userError" class="input-error text-red-400"></p>
                                    </div>
                                </div>
                                
                               
                                <div class="flex items-center justify-between">
                                 <button id="submitAddTaskBtn" type="button" class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="closeAddTaskBtn"  class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Close</button>
            </div>
        </div>
    </div>