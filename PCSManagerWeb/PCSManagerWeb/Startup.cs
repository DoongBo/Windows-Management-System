using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(PCSManagerWeb.Startup))]
namespace PCSManagerWeb
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
