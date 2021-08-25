<form class="w-full max-w-lg" wire:submit.prevent="submit">
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-indigo-800 text-xs font-bold mb-2 content" for="name">
          Name *
        </label>
        <input 
            class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
            id="name" 
            type="text"
            wire:model="name"
            >
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-indigo-800 text-xs font-bold mb-2 content" for="email">
          E-mail *
        </label>
        <input 
            class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
            id="email" 
            type="email"
            wire:model="email"
        >
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-indigo-800 text-xs font-bold mb-2 content" for="message">
          Message *
        </label>
        <textarea 
            class="no-resize appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" 
            id="message" 
            wire:model="message">
        </textarea>
      </div>
    </div>
    <div class="md:flex md:items-center">
      <div class="md:w-1/3">
        <button 
          class="shadow {{ $isDisabled ? 'text-indigo-400 cursor-not-allowed' :'text-indigo-800 hover:bg-indigo-500 focus:shadow-outline focus:outline-none'}} bg-indigo-300 font-bold py-2 px-4 rounded content"
          type="submit"
          {{ $isDisabled ? 'disabled' : ''}}>
          Send
        </button>
      </div>
      <div class="md:w-2/3"></div>
    </div>
  </form>