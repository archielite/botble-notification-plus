class TelegramSettingManagement {
    $form = $('.notification-settings-form')

    init() {
        $('.hrv-checkbox').on('change', (event) =>  {
            const $currentTarget = $(event.currentTarget)

            if ($currentTarget.prop('checked')) {
                $currentTarget.closest('.wrapper-content').find('.notification-wrapper').show()
                $currentTarget.closest('.form-group').removeClass('mb-0')
            } else {
                $currentTarget.closest('.wrapper-content').find('.notification-wrapper').hide()
                $currentTarget.closest('.form-group').addClass('mb-0')
            }
        })

        $('.send-test-message').on('click', async (event) => {
            event.preventDefault()
            event.stopPropagation()

            const $currentTarget = $(event.currentTarget)

            await this.saveSettings($currentTarget)

            const $modal = $('#send-test-message-modal')

            $modal.find('input[name="driver"]').val($currentTarget.data('driver'))
            $modal.modal('show')
        })

        $('#send-test-message-modal').on('click', '#send-test-message', (event) => {
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
        })

        this.$form.on('submit', async (event) => {
            event.preventDefault()
            event.stopPropagation()

            await this.saveSettings(this.$form.find('button[type="submit"]'))
        })

        $('#get-telegram-chat-ids').on('click', (event) => {
            event.preventDefault()
            event.stopPropagation()

            const $currentTarget = $(event.currentTarget)

            this.saveSettings($currentTarget)

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
        })

        $('input[name="notification_telegram_bot_token"]').on('change', (event) => {
            if ($(event.currentTarget).val()) {
                $('.telegram-chat-id-wrapper').show()
            } else {
                $('.telegram-chat-id-wrapper').hide()
            }
        })
    }

    async saveSettings($button) {
        await $.ajax({
            type: 'POST',
            url: route('notification-plus.settings'),
            data: this.$form.serialize(),
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
            }
        })
    }
}

$(document).ready(() => {
    new TelegramSettingManagement().init()
})
