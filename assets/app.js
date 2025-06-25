import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import '@symfony/stimulus-bundle';
import './styles/app.css';
import './controllers';

console.log('Assets loaded with AssetMapper + Stimulus!');
