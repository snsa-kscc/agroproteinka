
class ComponentManager
{
	constructor()
	{
		this.components = {};
	}

	registerComponents()
	{
		const files = require.context('../vue/', true, /\.vue$/i);

		files.keys().map((key) => {
			let componentName = key.split('/').pop().split('.')[0];
			this.components[componentName] = Vue.component(componentName, files(key).default);
		});
	}
}

export default ComponentManager;