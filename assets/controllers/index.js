import { Application } from '@hotwired/stimulus';
import ConfirmController from './confirm_controller.js';
import TestController from './test_controller.js';

const application = Application.start();
application.register('confirm', ConfirmController);
application.register('test', TestController);
