<template>
    <div v-if="errorsLs" class="text-red-500 py-4">
        <div v-for="(message, key) in errorsLs.message" :key="key">
            {{ message }}
        </div>
    </div>

    <div class="relative flex">
        <input v-model="formLs.message" type="text"
               placeholder="Message"
               @keyup.enter="sendMessageLs"
               class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600
                       placeholder-gray-600 pl-12 bg-gray-200 rounded-full py-3"
        >

        <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">
            <button @click="sendMessageLs" type="button" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 transform rotate-90">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                </svg>
            </button>
        </div>
        <div class="absolute left-0 items-center inset-y-0 hidden sm:flex inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-gray-400 hover:bg-gray-300 focus:outline-none">
            <input v-on:change="sendImages" type="file" id="image" name="image" class=""/>
            <svg fill="currentColor" height="22px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/></svg>
        </div>
    </div>
</template>

<script>
import {reactive} from 'vue';
import useChatLs from '../composables/chatLs';

export default {
    name: 'ChatFormLs',
    setup() {
        const formLs = reactive({
            message: '',
            image: '',
            to_user_id: document.querySelector("#user-id-chat").getAttribute('data-id')
        })

        const {errorsLs, addMessageLs} = useChatLs()

        const sendMessageLs = async () => {
            await addMessageLs(formLs)
            console.log(formLs);
            formLs.message = ''
            formLs.image = ''
        }
        const sendImages = async (e) => {
            const file = e.target.files[0];
            formLs.image = file;
            console.log(formLs.image);
        }

        return {
            errorsLs,
            formLs,
            sendMessageLs,
            sendImages
        }
    }
};
</script>

<style scoped>

</style>
