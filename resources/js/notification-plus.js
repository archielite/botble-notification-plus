class NotificationPlus {
    $form = $('.notification-settings-form')

    constructor() {
        this.$form.find('.send-test-message').on('click', async (event) => {
            await this.openSendTestMessageModal(event)
        })

        $('#send-test-message-modal').on('click', 'button#send-test-message-modal-button', (event) => {
            this.sendTestMessage(event)
        })

        this.$form.on('submit', async (event) => {
            event.preventDefault()
            event.stopPropagation()

            const $form = $(event.currentTarget)

            if ($form.valid()) {
                await this.saveSettings($form.find('button[type="submit"]'))
            }
        })

        this.$form.find('#get-telegram-chat-ids').on('click', async (event) => {
            await this.getTelegramChatIds(event)
        })

        $('.js-telegram-bot-token').on('change', (event) => {
            if ($(event.currentTarget).val()) {
                $('.telegram-chat-id-wrapper').show()
            } else {
                $('.telegram-chat-id-wrapper').hide()
            }
        })
    }

    async saveSettings($button, showSuccess = true) {
        const $form = $button.closest('form')

        await $httpClient
            .make()
            .withButtonLoading($button)
            .post($form.prop('action'), $form.serialize())
            .then(({ data }) => {
                if (showSuccess) {
                    Botble.showSuccess(data.message)
                }

                $form.find('.send-test-message').removeClass('d-none')
            })
    }

    async getTelegramChatIds(event) {
        event.preventDefault()
        event.stopPropagation()

        const $currentTarget = $(event.currentTarget)

        await this.saveSettings($currentTarget, false)

        $httpClient
            .make()
            .withButtonLoading($currentTarget)
            .post($currentTarget.data('url'))
            .then(({ data }) => {
                $('#telegram-list-chat-ids').html('')
                $.each(data, (key, value) => {
                    $('#telegram-list-chat-ids').append(`<li><code>${key}</code>: <strong>${value}</strong></li>`)
                })
            })
    }

    sendTestMessage(event) {
        event.preventDefault()
        event.stopPropagation()

        const $modal = $('#send-test-message-modal')
        const $form = $modal.find('form')
        const $button = $(event.currentTarget)

        $httpClient
            .make()
            .withButtonLoading($button)
            .post($form.prop('action'), $form.serialize())
            .then(({ data }) => {
                Botble.showSuccess(data.message)

                $modal.modal('hide')
            })
    }

    async openSendTestMessageModal(event) {
        event.preventDefault()
        event.stopPropagation()

        const $currentTarget = $(event.currentTarget)

        await this.saveSettings($currentTarget)

        const $modal = $('#send-test-message-modal')

        $modal.find('input[name="driver"]').val($currentTarget.data('driver'))
        $modal.modal('show')
    }
}

$(() => {
    new NotificationPlus()
})
