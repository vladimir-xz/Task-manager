import './bootstrap';

import 'flowbite';

import ujs from '@rails/ujs';

import Alpine from 'alpinejs';

import * as Sentry from "@sentry/browser";

Sentry.init({
  dsn: import.meta.env.VITE_SENTRY_DSN_PUBLIC,
});

window.Alpine = Alpine;

ujs.start();
Alpine.start();

