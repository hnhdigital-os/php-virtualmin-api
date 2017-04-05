<?php

namespace Bluora\Virtualmin\VirtualServers;

use Bluora\Virtualmin\VirtualminClient;

class VirtualServersClient extends VirtualminClient
{

    /**
     * Clone Domain.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/clone_domain
     *
     * @param string $domain
     * @param string $new_domain
     * @param array  $options
     *               - user
     *               - password
     *
     * @return integer
     */
    public function cloneDomain($domain, $new_domain, array $options = [])
    {
        $parameters = [];
        $parameters['domain'] = $domain;
        $parameters['new_domain'] = $new_domain;

        if (!empty($options['user'])) {
            $parameters['newuser'] = $$options['user'];
        }

        if (!empty($options['password'])) {
            $parameters['newpassword'] = $$options['password'];
        }

        return $this->call('clone-domain', $parameters);
    }

    private $create_domain_options = [
        'desc',
        'email',
        'user',
        'group',
        'unix',
        'dir',
        'dns',
        'mail',
        'web',
        'webalizer',
        'ssl',
        'logrotate',
        'mysql',
        'ftp',
        'spam',
        'virus',
        'status',
        'webmin',
        'virtualmin-awstats',
        'virtualmin-dav',
        'virtualmin-svn',
        'default-features',
        'features-from-plan',
        'allocate-ip',
        'ip',
        'shared-ip',
        'ip-already',
        'allocate-ip6',
        'ip6',
        'ip6-already',
        'dns-ip address',
        'no-dns-ip',
        'max-doms',
        'max-aliasdoms',
        'max-realdoms',
        'max-mailboxes',
        'max-dbs',
        'max-aliases',
        'quota',
        'uquota ',
        'template',
        'plan',
        'limits-from-plan',
        'prefix',
        'db',
        'fwdto',
        'reseller',
        'style',
        'content',
        'mysql-pass',
    ];

    private $create_domain_option_defaults = [
        'quota' => 'UNLIMITED',
        'uquota' => 'UNLIMITED',
    ];

    /**
     * Create virtual server.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/create_domain
     * 
     * @param string $domain
     * @param string $password
     *
     * @return integer
     */
    public function create($domain, $password, array $options = [])
    {
        $parameters = [];
        $parameters['domain'] = $domain;
        $parameters['pass'] = $password;

        foreach ($this->create_domain_options as $key) {
            if (!empty($options[$key])) {
                $parameters[$key] = $options[$key];
            }
        }

        foreach ($this->create_domain_option_defaults as $key => $value) {
            if (!isset($parameters[$key])) {
                $parameters[$key] = $value;
            }
        }

        return $this->call('create-domain', $parameters);
    }

    /**
     * Create child virtual server under existing virtual server.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/create_domain
     *
     * @param string $parent_domain
     * @param string $domain
     * @param string $password
     *
     * @return integer
     */
    public function createChild($parent_domain, $domain, $password, array $options = [])
    {
        $parameters = [];
        $parameters['parent '] = $parent_domain;
        $parameters['domain'] = $domain;

        foreach ($this->create_domain_options as $key) {
            if (!empty($options[$key])) {
                $parameters[$key] = $options[$key];
            }
        }

        foreach ($this->create_domain_option_defaults as $key => $value) {
            if (!isset($parameters[$key])) {
                $parameters[$key] = $value;
            }
        }

        return $this->call('create-domain', $parameters);
    }

    /**
     * Create alias to existing virtual server.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/create_domain
     *
     * @param string $parent_domain
     * @param string $domain
     *
     * @return integer
     */
    public function createAlias($parent_domain, $domain, array $options = [])
    {
        $parameters = [];
        $parameters['alias'] = $parent_domain;
        $parameters['domain'] = $domain;

        foreach ($this->create_domain_options as $key) {
            if (!empty($options[$key])) {
                $parameters[$key] = $options[$key];
            }
        }

        foreach ($this->create_domain_option_defaults as $key => $value) {
            if (!isset($parameters[$key])) {
                $parameters[$key] = $value;
            }
        }

        return $this->call('create-domain', $parameters);
    }

    /**
     * Delete virtual server.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/delete_domain
     *
     * @param string $domain
     *
     * @return integer
     */
    public function delete($domain)
    {
        $parameters = [];
        $parameters['domain'] = $domain;

        return $this->call('delete-domain', $parameters);
    }

    /**
     * Delete virtual server by user.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/delete_domain
     *
     * @param string $user
     *
     * @return integer
     */
    public function deleteByUser($user)
    {
        $parameters = [];
        $parameters['user'] = $user;

        return $this->call('delete-domain', $parameters);
    }

    /**
     * Remove domain from virtualmin's control.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/delete_domain
     *
     * @param string $domain
     *
     * @return integer
     */
    public function removeFromVirtualmin($domain)
    {
        $parameters = [];
        $parameters['domain'] = $domain;
        $parameters['only'] = true;

        return $this->call('delete-domain', $parameters);
    }

    /**
     * Remove domain by user from virtualmin's control.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/delete_domain
     *
     * @param string $domain
     *
     * @return integer
     */
    public function removeByUserFromVirtualmin($user)
    {
        $parameters = [];
        $parameters['user'] = $user;
        $parameters['only'] = true;

        return $this->call('delete-domain', $parameters);
    }

    /**
     * Disable virtual server.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/disable_domain
     *
     * @param string $domain
     *
     * @return integer
     */
    public function disable($domain, $why = '')
    {
        $parameters = [];
        $parameters['domain'] = $domain;
        if (!empty($why)) {
            $parameters['why'] = $why;
        }

        return $this->call('disable-domain', $parameters);
    }

    private $feature_list = [
        'unix',
        'dir',
        'dns',
        'mail',
        'web',
        'webalizer',
        'ssl',
        'logrotate',
        'mysql',
        'ftp',
        'spam',
        'virus',
        'status',
        'webmin',
        'virtualmin-awstats',
        'virtualmin-dav',
        'virtualmin-svn',
    ];

    public function disableFeatureByDomain($domain, $feature)
    {
        $parameters = [];
        $parameters['domain'] = $domain;
        $parameters[$feature] = true;

        if (!in_array($feature, $this->feature_list)) {
            return 1;
        }

        return $this->call('disable-feature', $parameters);
    }

    public function disableFeatureByUser($user, $feature)
    {
        $parameters = [];
        $parameters['user'] = $user;
        $parameters[$feature] = true;

        if (!in_array($feature, $this->feature_list)) {
            return 1;
        }

        return $this->call('disable-feature', $parameters);
    }

    public function disableFeatureAllDomains($feature)
    {
        $parameters = [];
        $parameters['all-domains'] = true;
        $parameters[$feature] = true;

        if (!in_array($feature, $this->feature_list)) {
            return 1;
        }

        return $this->call('disable-feature', $parameters);
    }

    /**
     * Disable unix feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableUnix($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'unix');
    }

    /**
     * Disable dir feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableDir($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'dir');
    }

    /**
     * Disable dns feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableDns($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'dns');
    }

    /**
     * Disable mail feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableMail($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'mail');
    }

    /**
     * Disable web feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableWeb($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'web');
    }

    /**
     * Disable webalizer feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableWebalizer($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'webalizer');
    }

    /**
     * Disable ssl feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableSsl($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'ssl');
    }

    /**
     * Disable logrotate feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableLogRotate($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'logrotate');
    }

    /**
     * Disable mysql feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableLogMySql($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'mysql');
    }

    /**
     * Disable ftp feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableLogFtp($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'ftp');
    }

    /**
     * Disable spam feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableSpam($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'spam');
    }

    /**
     * Disable virus feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableVirus($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virus');
    }

    /**
     * Disable status feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableStatus($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'status');
    }

    /**
     * Disable webmin feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableWebmin($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'webmin');
    }

    /**
     * Disable awstats feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableAwstats($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virtualmin-awstats');
    }

    /**
     * Disable dav feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableDav($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virtualmin-dav');
    }

    /**
     * Disable svn feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function disableSvn($domain = false, $user = false)
    {
        $method = 'disableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virtualmin-svn');
    }

    /**
     * Enable virtual server.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/enable_domain
     *
     * @param string $domain
     *
     * @return integer
     */
    public function enableDomain($domain)
    {
        $parameters = [];
        $parameters['domain'] = $domain;

        return $this->call('enable-domain', $parameters);
    }

    public function enableFeatureByDomain($domain, $feature)
    {
        $parameters = [];
        $parameters['domain'] = $domain;
        $parameters[$feature] = true;

        if (!in_array($feature, $this->feature_list)) {
            return 1;
        }

        return $this->call('enable-feature', $parameters);
    }

    public function enableFeatureByUser($user, $feature)
    {
        $parameters = [];
        $parameters['user'] = $user;
        $parameters[$feature] = true;

        if (!in_array($feature, $this->feature_list)) {
            return 1;
        }

        return $this->call('enable-feature', $parameters);
    }

    public function enableFeatureAllDomains($feature)
    {
        $parameters = [];
        $parameters['all-domains'] = true;
        $parameters[$feature] = true;

        if (!in_array($feature, $this->feature_list)) {
            return 1;
        }

        return $this->call('enable-feature', $parameters);
    }

    /**
     * Enable unix feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableUnix($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'unix');
    }

    /**
     * Enable dir feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableDir($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'dir');
    }

    /**
     * Enable dns feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableDns($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'dns');
    }

    /**
     * Enable mail feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableMail($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'mail');
    }

    /**
     * Enable web feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableWeb($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'web');
    }

    /**
     * Enable webalizer feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableWebalizer($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'webalizer');
    }

    /**
     * Enable ssl feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableSsl($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'ssl');
    }

    /**
     * Enable logrotate feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableLogRotate($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'logrotate');
    }

    /**
     * Enable mysql feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableLogMySql($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'mysql');
    }

    /**
     * Enable ftp feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableLogFtp($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'ftp');
    }

    /**
     * Enable spam feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableSpam($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'spam');
    }

    /**
     * Enable virus feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableVirus($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virus');
    }

    /**
     * Enable status feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableStatus($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'status');
    }

    /**
     * Enable webmin feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableWebmin($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'webmin');
    }

    /**
     * Enable awstats feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableAwstats($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virtualmin-awstats');
    }

    /**
     * Enable dav feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableDav($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virtualmin-dav');
    }

    /**
     * Enable svn feature by domain or user.
     *
     * @param  string|boolean $domain
     * @param  string|boolean $user
     *
     * @return integer
     */
    public function enableSvn($domain = false, $user = false)
    {
        $method = 'enableFeatureBy' . ($domain !== false) ? 'Domain' : 'User';

        return $this->$method($domain, 'virtualmin-svn');
    }

    private $list_domains_terms = [
        'multiline',
        'name-only',
        'id-only',
        'simple-multiline',
        'user-only',
        'home-only',
        'domain',
        'user',
        'id number',
        'with-feature',
        'without-feature',
        'alias',
        'no-alias',
        'subserver',
        'toplevel',
        'subdomain',
        'plan',
        'reseller',
        'no-reseller',
        'any-reseller',
    ];

    /**
     * List domains.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/list_domains
     *
     * @param  array  $options
     *
     * @return array
     */
    public function listDomains(array $options = [])
    {
        $parameters = [];
        $parameters['multiline'] = true;

        foreach ($this->list_domains_terms as $key) {
            if (!empty($options[$key])) {
                $parameters[$key] = $options[$key];
            }
        }

        return $this->call('list-domains', $parameters);
    }

    /**
     * Migrate domains.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/migrate_domains
     *
     * @param  array  $options
     *
     * @return array
     */
    public function migrateDomain(array $options = [])
    {
        $parameters = [];

        return $this->call('migrate-domains', $parameters);
    }

    /**
     * Modify DNS.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/modify_dns
     *
     * @param  array  $options
     *
     * @return array
     */
    public function modifyDns(array $options = [])
    {
        $parameters = [];

        return $this->call('modify-dns', $parameters);
    }

    /**
     * Modify Domain.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/modify_domain
     *
     * @param  array  $options
     *
     * @return array
     */
    public function modifyDomain(array $options = [])
    {
        $parameters = [];

        return $this->call('modify-domain', $parameters);
    }

    /**
     * Modify mail.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/modify_mail
     *
     * @param  array  $options
     *
     * @return array
     */
    public function modifyMail(array $options = [])
    {
        $parameters = [];

        return $this->call('modify-mail', $parameters);
    }

    /**
     * Modify SPAM.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/modify_spam
     *
     * @param  array  $options
     *
     * @return array
     */
    public function modifySpam(array $options = [])
    {
        $parameters = [];

        return $this->call('modify-spam', $parameters);
    }

    /**
     * Modify Web.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/modify_web
     *
     * @param  array  $options
     *
     * @return array
     */
    public function modifyWeb(array $options = [])
    {
        $parameters = [];

        return $this->call('modify-web', $parameters);
    }

    /**
     * Move domain.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/move_domain
     *
     * @param  array  $options
     *
     * @return array
     */
    public function moveDomain(array $options = [])
    {
        $parameters = [];

        return $this->call('move-domain', $parameters);
    }

    /**
     * Notify domains.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/notify_domains
     *
     * @param  array  $options
     *
     * @return array
     */
    public function notifyDomains(array $options = [])
    {
        $parameters = [];

        return $this->call('notify-domains', $parameters);
    }

    /**
     * Resend email.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/resend_email
     *
     * @param  array  $options
     *
     * @return array
     */
    public function resendEmail(array $options = [])
    {
        $parameters = [];

        return $this->call('resend-email', $parameters);
    }

    /**
     * Unalias domain.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/unalias_domain
     *
     * @param  array  $options
     *
     * @return array
     */
    public function unaliasDomain(array $options = [])
    {
        $parameters = [];

        return $this->call('unalias-domain', $parameters);
    }

    /**
     * Unsub domain.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/unsub_domain
     *
     * @param  array  $options
     *
     * @return array
     */
    public function unsubDomain(array $options = [])
    {
        $parameters = [];

        return $this->call('unsub-domain', $parameters);
    }

    /**
     * Validate domains.
     *
     * @link https://www.virtualmin.com/documentation/developer/cli/validate_domain
     *
     * @param  array  $options
     *
     * @return array
     */
    public function validateDomain(array $options = [])
    {
        $parameters = [];

        return $this->call('validate-domain', $parameters);
    }
}