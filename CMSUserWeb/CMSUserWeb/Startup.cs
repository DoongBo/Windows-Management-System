using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(CMSUserWeb.Startup))]
namespace CMSUserWeb
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
