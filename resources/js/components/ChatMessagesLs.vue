<template>
    <div id="scroll-down" style="max-height: 65vh;" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">

    <div class="chat-message" v-for="message in messagesLs">
        <div class="flex items-end" :class="{'justify-end': message.user.id == user.id}">
            <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2" :class="{'items-end': message.user.id == user.id, 'items-start': message.user.id != user.id}">
                <div class="flex flex-col" :class="{'flex-end': message.user.id == user.id}">
                    <span class="px-4 py-2 rounded-lg inline-block"
                          :class="{'rounded-br-none bg-blue-600 text-white': message.user.id == user.id, 'rounded-bl-none bg-gray-300 text-gray-600': message.user.id != user.id}"
                    >
                        <div v-if="message.image !=''">
                            <a v-bind:href="message.image" data-lightbox="roadtrip">
                        <img v-bind:src="message.image">
                            </a>
                        </div>
                        {{ message.message }}
                    </span>
                    <m :class="{'text-right': message.user.id == user.id}">{{message.user.name}}</m>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import useChatLs from '../composables/chatLs';
import {onMounted} from 'vue';

export default {
    name: 'ChatMessagesLs',
    props: {
        user: {
            required: true,
            type: Object
        }
    },
    methods: {
        handleScroll: function (evt, el) {
            if (window.scrollY > 50) {
                el.setAttribute(
                    'style',
                    'opacity: 1; transform: translate3d(0, -10px, 0)'
                )
            }
            return window.scrollY > 100
        }
    },

    setup() {
        const {messagesLs, getMessagesLs} = useChatLs()

        onMounted(getMessagesLs)

        Echo.private('chat')
            .listen('LsMessageSent', (e) => {
                messagesLs.value.push({
                    message: e.message.message,
                    image: e.message.image,
                    user: e.user
                });
            });

        return {
            messagesLs
        }
    }
};
</script>
