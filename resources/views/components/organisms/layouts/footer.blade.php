<x-molecules.toast-notifications.tn />

@use('Illuminate\Support\Js')

<div x-data x-init="
    (() => {
        const incoming = {{ Js::from(collect(['success', 'error', 'warning', 'info'])->flatMap(fn($type) => session()->has($type) ? [['type' => $type, 'message' => session($type)]] : [])->concat(collect($errors->all())->map(fn($error) => ['type' => 'error', 'message' => $error]))->values()) }};

        incoming.forEach(notification => {
            if (typeof notifications !== 'undefined') {
                notifications.push({
                    id: Date.now() + Math.random(), ...notification
                });
            }
        });
    })()
"></div>
