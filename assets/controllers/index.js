import { Application } from '@hotwired/stimulus'
import TestController from './test_controller.js'

const application = Application.start()
application.register('test', TestController)
