class NotificationPlus {
    $form = $('.notification-settings-form')

    constructor() {
        this.$form.find('.enable-notification-item-checkbox').on('change', async (event) =>  {
            const $currentTarget = $(event.currentTarget)

            if ($currentTarget.prop('checked')) {
                $currentTarget.closest('.wrapper-content').find('.notification-wrapper').show()
                $currentTarget.closest('.form-group').removeClass('mb-0')
            } else {
                $currentTarget.closest('.wrapper-content').find('.notification-wrapper').hide()
                $currentTarget.closest('.form-group').addClass('mb-0')
            }

            await this.saveSettings($currentTarget.closest('form').find('button[type="submit"]'))
        })

        this.$form.find('.send-test-message').on('click', async (event) => {
            await this.openSendTestMessageModal(event)
        })

        $('#send-test-message-modal').on('click', 'button[type="submit"]', (event) => {
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

        await $.ajax({
            type: 'POST',
            url: route('notification-plus.settings'),
            data: $form.serialize(),
            beforeSend: () => {
                $button.addClass('button-loading')
            },
            success: (response) => {
                const { message, error } = response

                if (error) {
                    Botble.showError(message)
                    return
                }

                if (showSuccess) {
                    Botble.showSuccess(message)
                }

                $form.find('.send-test-message').removeClass('d-none')
            },
            error: (error) => {
                Botble.handleError(error)
            },
            complete: () => {
                $button.removeClass('button-loading')
            }
        })
    }

    async getTelegramChatIds(event) {
        event.preventDefault()
        event.stopPropagation()

        const $currentTarget = $(event.currentTarget)

        await this.saveSettings($currentTarget, false)

        $.ajax({
            type: 'POST',
            url: route('notification-plus.get-telegram-chat-ids'),
            beforeSend: () => {
                $currentTarget.addClass('button-loading')
            },
            success: (response) => {
                const { message, error, data } = response

                if (error) {
                    Botble.showError(message)
                    return
                }

                $('#telegram-list-chat-ids').html('')
                $.each(data, (key, value) => {
                    $('#telegram-list-chat-ids').append(`<li><code>${key}</code>: <strong>${value}</strong></li>`)
                })
            },
            error: (error) => {
                Botble.handleError(error)
            },
            complete: () => {
                $currentTarget.removeClass('button-loading')
            }
        })
    }

    sendTestMessage(event) {
        event.preventDefault()
        event.stopPropagation()

        const $modal = $('#send-test-message-modal')
        const $form = $modal.find('form')
        const $button = $(event.currentTarget)

        $.ajax({
            type: 'POST',
            url: $form.prop('action'),
            data: $form.serialize(),
            beforeSend: () => {
                $button.addClass('button-loading')
            },
            success: (response) => {
                const { message, error } = response

                if (error) {
                    Botble.showError(message)
                    return
                }

                Botble.showSuccess(message)
            },
            error: (error) => {
                Botble.handleError(error)
            },
            complete: () => {
                $button.removeClass('button-loading')
                $modal.modal('hide')
            }
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

$(document).ready(() => {
    new NotificationPlus()
})
