export default [
    {
        files: ["resources/js/**/*.js"],
        languageOptions: {
            ecmaVersion: 2021,
            sourceType: "module",
        },
        rules: {
            "no-unused-vars": "warn",
            "no-console": "off",
        },
    },
];
