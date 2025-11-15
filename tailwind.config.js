module.exports = {
    content: [
        './src/Infrastructure/Twig/templates/**/*.twig',
        './assets/**/*.js',
    ],
    theme: { extend: {} },
    plugins: [require('daisyui')],
}
