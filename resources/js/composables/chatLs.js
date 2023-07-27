import {ref} from 'vue';
import axios from 'axios';
function showNotification({top = 0, right = 0, className, html}) {

    let notification = document.createElement('div');
    notification.className = "notification";
    if (className) {
        notification.classList.add(className);
    }

    notification.style.top = top + 'px';
    notification.style.right = right + 'px';

    notification.innerHTML = html;
    document.body.append(notification);

    setTimeout(() => notification.remove(), 200000);
}
export default function useChatLs() {
    const messagesLs = ref([])
    const errorsLs = ref([])
    const idUser = document.querySelector("#user-id-chat").getAttribute('data-id')
    const getMessagesLs = async () => {
        await axios.get('/ls-messages/'+ idUser).then((response) => {
            messagesLs.value = response.data
        })
    }

    const addMessageLs = async (formLs) => {
        errorsLs.value = [];
        try {
            await axios.post('/ls-send', formLs, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {
                messagesLs.value.push(response.data)
                /*showNotification({
                    top: 10,
                    right: 10,
                    html: nameSendler,
                    className: "new-message-allert"
                });
                console.log(response.data.user_id)*/
            })
        } catch (e) {
            if(e.response.status === 422) {
                errorsLs.value = e.response.data.errors
            }
        }
        document.querySelector('#scroll-down').scrollTo(0, document.querySelector('#scroll-down').scrollHeight);
    }

    return {
        messagesLs,
        errorsLs,
        getMessagesLs,
        addMessageLs
    }
}
