const { createApp, ref, onMounted, watch } = Vue

//Fullcalendarを使用
//API非同期通信,axios
//データ変更時のUI変更、コンポーネント管理VueJS
createApp({
    setup() {
        const selectedDate = ref()
        const scheduleParams = ref({id: '', date: '', allDay: true, title: '', descrpition: '', start: '', end: '', register: {id: '', name: ''},})
        const isEdit = ref(false)
        const selectedUsers = ref([])
        const selectedUserNames = ref([])
        let calendar
        let modalRegist
        let modalDetail
        onMounted(async () => {
            modalRegist = new bootstrap.Modal(document.getElementById('modal-regist'), {
                backdrop: 'static',
            })
            modalDetail = new bootstrap.Modal(document.getElementById('modal-detail'), {
                backdrop: 'static',
            })
            const calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ja',
                buttonText: {
                    prev:     '<',
                    next:     '>',
                    prevYear: '<<',
                    nextYear: '>>',
                    today:    '今日',
                    month:    '月',
                    week:     '週',
                    day:      '日',
                    list:     '一覧'
                },
                loading: function(isLoading) {
                    showLoading('データ取得中…')
                    if (!isLoading) {
                        modalRegist.hide()
                        hideLoading()
                    }
                },
                events: function(info, callback) {
                    getEvents(info, callback)
                },
                datesSet: async (info) => {
                },
                dateClick: function(info) {
                    scheduleParams.value = {id: '', date: '', allDay: true, title: '', descrpition: '', start: '', end: '', register: {id: '', name: ''}}
                    selectedDate.value = info.date.toLocaleDateString('ja-JP')
                    scheduleParams.value.date = info.date.toLocaleDateString('ja-JP')
                    modalRegist.show()
                },
                eventClick: async (info) => {
                    const response = await axios.get(`/api/calendar/${info.event.id}`)
                    const data = response.data
                    scheduleParams.value.id = data.id
                    scheduleParams.value.date = new Date(data.start).toLocaleDateString('ja-JP')
                    scheduleParams.value.title = data.title
                    scheduleParams.value.description = data.description
                    scheduleParams.value.allDay = data.allDay
                    if (!data.allDay) {
                        scheduleParams.value.start = convertTime(data.start)
                        scheduleParams.value.end = convertTime(data.end)
                    } else {
                        scheduleParams.value.start = ''
                        scheduleParams.value.end = ''
                    }
                    scheduleParams.value.register.name = data.data.register.name
                    selectedUsers.value = data.eventMembers.map(v => v.id)
                    selectedUserNames.value = data.eventMembers.map(v => v.name)
                    selectedDate.value = scheduleParams.value.date
                    if (data.data.register.id === loginUser.id) {
                        modalRegist.show()
                    } else {
                        modalDetail.show()
                    }
                }
            })
            calendar.render()
        })

        const convertTime = (value) => {
            const date = new Date(value)
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            return timeString = hours + ':' + minutes;
        }

        const getEvents = async (info, callback) => {
            try {
                const params = {
                    start: info.start.toLocaleDateString('ja-JP'),
                    end: info.end.toLocaleDateString('ja-JP'),
                }
                const response = await axios.get(`/api/calendar?start=${params.start}&end=${params.end}`)
                callback(response.data.data)
            } catch (error) {
                hideLoading()
            } finally {
            }
        }

        const updateSchedule = async () => {
            try {
                showLoading('スケジュール登録中…')
                const params = {
                    id: scheduleParams.value.id,
                    date: scheduleParams.value.date,
                    title: scheduleParams.value.title,
                    description: scheduleParams.value.description,
                    start_time: scheduleParams.value.start,
                    end_time: scheduleParams.value.end,
                    all_day_flag: scheduleParams.value.allDay,
                    url: null,
                    users: selectedUsers.value,
                }
                if (params.id) {
                    const response = await axios.put(`/api/calendar/${params.id}`, params)
                } else {
                    const response = await axios.post(`/api/calendar`, params)
                }
                calendar.refetchEvents();
            } catch (error) {
                hideLoading()
            } finally {
            }
        }

        const executeDelete = async () => {
            try {
                showLoading('データ削除中…')
                await axios.delete(`/api/calendar/${scheduleParams.value.id}`)
                calendar.refetchEvents();
            } catch (error) {
                hideLoading()
            } finally {
            }
        }

        return {
            selectedDate,
            updateSchedule,
            scheduleParams,
            executeDelete,
            isEdit,
            selectedUsers,
            selectedUserNames,
        }
    }
}).mount('#app')
