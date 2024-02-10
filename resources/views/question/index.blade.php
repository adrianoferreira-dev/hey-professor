<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea label="Question" name="question"/>
            <x-btn.primary>Save</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4"/>

        <div class="dark:text-gray-400 uppercase font-bold mb-1 ">Drafts</div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($questions->where('draft', true) as $item)
                    <x-table.tr>
                        <x-table.td>{{  $item->question }}</x-table.td>
                        <x-table.td>
                            <x-form :action="route('question.destroy', $item)" delete onsubmit="return confirm('Tem certeza?')">
                                <button type="submit" class="hover:underline text-red-500">
                                    Delete
                                </button>
                            </x-form>
                            <x-form :action="route('question.publish', $item)" put>
                                <button type="submit" class="hover:underline text-blue-500">
                                    Publish
                                </button>
                            </x-form>
                            <a href="{{ route('question.edit', $item) }}" class="hover:underline text-gray-500">
                                Edit
                            </a>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>
        </div>

        <hr class="border-gray-700 border-dashed my-4"/>

        <div class="dark:text-gray-400 uppercase font-bold mb-1 ">My Questions</div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($questions->where('draft', false) as $item)
                    <x-table.tr>
                        <x-table.td>{{  $item->question }}</x-table.td>
                        <x-table.td>
                            <x-form :action="route('question.destroy', $item)" delete onsubmit="return confirm('Tem certeza?')">
                                <button type="submit" class="hover:underline text-red-500">
                                    Delete
                                </button>
                            </x-form>
                            <x-form :action="route('question.archive', $item)" patch>
                                <button type="submit" class="hover:underline text-red-500">
                                    Archive
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>
        </div>

        <hr class="border-gray-700 border-dashed my-4"/>

        <div class="dark:text-gray-400 uppercase font-bold mb-1 ">Archived Questions</div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($archivedQuestions as $item)
                    <x-table.tr>
                        <x-table.td>{{  $item->question }}</x-table.td>
                        <x-table.td>
                            <x-form :action="route('question.restore', $item)" patch>
                                <button type="submit" class="hover:underline text-blue-500">
                                    Restore
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>
        </div>
    </x-container>
</x-app-layout>
