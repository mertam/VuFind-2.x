<?php
/**
 * Factory for instantiating SMS objects
 *
 * PHP version 5
 *
 * Copyright (C) Villanova University 2009.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @category VuFind2
 * @package  SMS
 * @author   Ronan McHugh <vufind-tech@lists.sourceforge.net>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/system_classes Wiki
 */
namespace VuFind\SMS;
use VuFind\Config\Reader as ConfigReader,
    Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for instantiating SMS objects
 *
 * @category VuFind2
 * @package  SMS
 * @author   Ronan McHugh <vufind-tech@lists.sourceforge.net>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/system_classes Wiki
 */
class Factory implements \Zend\ServiceManager\FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $sm Service manager
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $sm)
    {
        // Load configurations:
        $mainConfig = ConfigReader::getConfig();
        $smsConfig = ConfigReader::getConfig('sms');

        // Determine SMS type:
        $type = isset($smsConfig->General->smsType)
            ? $smsConfig->General->smsType : 'Mailer';

        // Initialize object based on requested type:
        switch (strtolower($type)) {
        case 'clickatell':
            return new Clickatell($smsConfig);
        case 'mailer':
            $options = array('mailer' => $sm->get('VuFind\Mailer'));
            if (isset($mainConfig->Site->email)) {
                $options['defaultFrom'] = $mainConfig->Site->email;
            }
            return new Mailer($smsConfig, $options);
        default:
            throw new \Exception('Unrecognized SMS type: ' . $type);
        }
    }
}